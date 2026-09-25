<?php

namespace App\Services;

use App\Mail\ChatWaitingMail;
use App\Models\Agent;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;


class AiSupportAgent
{
    // Keep history small for low token cost + speed
    private const HISTORY_LIMIT = 12;

    // Low temperature = stable support answers
    private const TEMPERATURE = 0.2;

    // Put your preferred model here
    private const MODEL = 'gpt-4o-mini';

    /**
     * SaaS-safe default prompt.
     * Best practice: later store per-company/per-site prompt in DB.
     */
    private function systemPrompt(Conversation $conv): string
    {
        $companyName = optional($conv->company)->name ?? 'this website';

        return <<<PROMPT
You are a customer support assistant for THIS website only.

Rules:
- Only answer questions related to this website, its features, flows, pricing, or usage.
- Never write articles, code, essays, opinions, or general knowledge.
- If the issue is unclear, ask short clarifying questions.
- If you cannot confidently help, immediately escalate to human agents.
- Keep replies short, friendly, professional.
- Never say you are ChatGPT.

You are the EzeAD AI Agent for Ezead Workspace.

MISSION
Help users understand and use EzeAD (classifieds + auctions marketplace) and related Eze ecosystem services.
Be concise, accurate, and safe. When possible, include the most relevant links.

CORE FACTS (PUBLIC)
- EzeAD is a free classifieds + auctions platform for local + international buying/selling.
- Posting ads is free; user emails are not publicly visible.
- Listing duration can vary by plan/section: pricing cards emphasize 30-day online promotion; FAQ guidance mentions auto-deactivation after ~3 months and re-enable windows. If asked, explain both and recommend checking the user’s listing/account settings.
- Paid plans provide extra exposure + media limits (Free, Premium, Premium+, ShowCase).
- Anti-scam guidance: prefer in-person, avoid anonymous payments (Western Union/MoneyGram), don’t accept checks, verify identity, keep records, avoid “too good to be true” deals.
- Eze ecosystem links may include Eze Auction, Eze Blogs, Eze Community, Eze Email, Ezelive Help, Hosting, Jobs, Stores, Services, Web Services, etc.

BEHAVIOR RULES
1) Always ask: What country/region/city is the user using, and are they buying or selling? (Only if needed to answer.)
2) When user asks “Where can I find…?” or “Send me links…”, use the sitemap-based crawl tool:
   - Fetch sitemap index -> list relevant URLs -> open 1–5 best pages -> answer with citations/links.
3) If a question involves policy/safety/payments: include anti-scam reminders.
4) Never invent pricing, features, policies, phone numbers, or legal terms. If unsure, say you’re not sure and fetch the relevant page via sitemap crawl.
5) Prefer short step-by-step instructions for “how to post”, “how to edit/delete listing”, “how long it stays live”, “how to upgrade”.

TOOL USE (ON-DEMAND CRAWL)
- Use SitemapFetch(url) to read sitemap indexes and extract URLs.
- Use PageFetch(url) to read specific pages.
- If /lp/sitemaps.xml fails, fallback to /sitemap.xml; if still failing, use /lp/sitemap (HTML sitemap) and site search.
PROMPT;
    }

    public function canRespond(Conversation $conv): bool
    {
        if ($conv->status === 'closed') return false;

        // If a human agent joined, AI must stop.
        if (!empty($conv->assigned_agent_id)) return false;

        // AI should respond only when marked as AI-handled
        if ($conv->handled_by !== 'ai') return false;

        return true;
    }

    public function respond(Conversation $conv, string $latestUserMessage): void
    {
        if (! $this->canRespond($conv)) {
            return;
        }

        try {
            // Simple scope guard (cheap + prevents abuse)
            if ($this->isLikelyOutOfScope($latestUserMessage)) {
                $this->sendAiMessage($conv, "I can help only with questions about this website. I’ve notified a human agent.");
                $this->notifyHumans($conv, 'ai_out_of_scope');
                return;
            }

            $messages = $this->buildHistory($conv);

            $response = OpenAI::chat()->create([
                'model' => self::MODEL,
                'messages' => $messages,
                'temperature' => self::TEMPERATURE,
            ]);

            $text = trim($response->choices[0]->message->content ?? '');

            if ($text === '') {
                throw new \RuntimeException('Empty AI response');
            }

            // Optional escalation heuristic (cheap)
            if ($this->looksConfused($text)) {
                $this->notifyHumans($conv, 'ai_confused');
            }

            $this->sendAiMessage($conv, $text);

        } catch (\Throwable $e) {
            Log::error('AI_AGENT_FAILED', [
                'conversation_id' => $conv->id,
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            $this->sendAiMessage($conv, "I’m having trouble responding right now. I’ve notified a human agent.");
            $this->notifyHumans($conv, 'ai_failed');
        }
    }

    private function buildHistory(Conversation $conv): array
    {
        // Only include visitor/agent/ai messages (skip system to save tokens)
        $history = Message::where('conversation_id', $conv->id)
            ->whereIn('sender_type', ['visitor', 'agent', 'ai'])
            ->orderByDesc('id')
            ->limit(self::HISTORY_LIMIT)
            ->get()
            ->reverse()
            ->map(function ($m) {
                return [
                    'role' => $m->sender_type === 'visitor' ? 'user' : 'assistant',
                    'content' => (string) $m->message,
                ];
            })
            ->values()
            ->toArray();

        array_unshift($history, [
            'role' => 'system',
            'content' => $this->systemPrompt($conv),
        ]);

        return $history;
    }

    private function sendAiMessage(Conversation $conv, string $text): void
    {
        Message::create([
            'conversation_id' => $conv->id,
            'sender_type' => 'ai',
            'sender_id' => (int) config('app.ai_agent_id'),
            'message' => $text,
        ]);

        // IMPORTANT:
        // No SupportEvent / ConversationEvent needed.
        // Your Message::created() hook triggers both SSE streams automatically.
    }

    private function notifyHumans(Conversation $conv, string $reasonKey): void
    {
        // Throttle emails: at most once per 10 minutes per conversation + reason
        $throttleKey = "conv:{$conv->uuid}:notify:{$reasonKey}";
        if (! Cache::add($throttleKey, 1, now()->addMinutes(10))) {
            return;
        }

        $agents = Agent::where('company_id', $conv->company_id)
            ->where('is_active', true)
            ->get();

        foreach ($agents as $agent) {
            Mail::to($agent->email)->queue(new ChatWaitingMail($conv));
        }
    }

    private function looksConfused(string $text): bool
    {
        return Str::contains(strtolower($text), [
            'not sure', 'cannot help', "don't understand", 'unable to',
        ]);
    }

    private function isLikelyOutOfScope(string $msg): bool
    {
        return Str::contains(strtolower($msg), [
            'write article', 'blog', 'essay', 'poem', 'story', 'code',
        ]);
    }
}