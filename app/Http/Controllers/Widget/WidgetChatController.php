<?php

namespace App\Http\Controllers\Widget;

use App\Http\Controllers\Controller;
use App\Helpers\AgentPresence;
use App\Jobs\AiRespondToConversationJob;
use App\Mail\ChatWaitingMail;
use App\Models\Agent;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class WidgetChatController extends Controller
{
    private const WAIT_SECONDS = 60;

    private function site(Request $request)
    {
        return $request->attributes->get('company_site');
    }

    private function waitUntil(Conversation $conv)
    {
        return $conv->created_at->copy()->addSeconds(self::WAIT_SECONDS);
    }

    public function validateKey(Request $request)
    {
        $site = $this->site($request);

        if (!$site) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid or inactive widget key.'
            ], 404);
        }

        return response()->json([
            'valid' => true,
            'site_id' => $site->id,
            'site_name' => $site->company->name,
            'company_id' => $site->company_id,
        ]);
    }

    public function start(Request $request)
    {
        $site = $this->site($request);

        $request->validate([
            'name' => 'nullable|string|max:120',
            'email' => 'nullable|email|max:190',
        ]);

        $onlineAgents = AgentPresence::onlineAgents($site->company_id);

        $conversation = Conversation::create([
            'uuid' => (string) Str::uuid(),
            'company_id' => $site->company_id,
            'company_site_id' => $site->id,
            'status' => 'open',
            'visitor_name' => $request->name,
            'visitor_email' => $request->email,
        ]);

        // System message => triggers BOTH SSE streams via Message::created() hook
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'system',
            'sender_id' => null,
            'message' => 'Chat started. A support agent will join shortly.',
        ]);

        // If no agents online => join AI instantly
        if ($onlineAgents->isEmpty()) {
            $this->joinAiAndNotify($conversation);
            $conversation->refresh();
        }

        return response()->json([
            'uuid' => $conversation->uuid,
            'agents_online' => $onlineAgents->isNotEmpty(),
            'wait_until' => $this->waitUntil($conversation),
            'handled_by' => $conversation->handled_by,
        ]);
    }

    public function checkAssignment(Request $request)
    {
        $site = $this->site($request);

        $request->validate([
            'uuid' => 'required|string'
        ]);

        $conversation = Conversation::where('uuid', $request->uuid)
            ->where('company_site_id', $site->id)
            ->where('status', 'open')
            ->firstOrFail();

        // Human joined?
        if (!empty($conversation->assigned_agent_id)) {
            return response()->json([
                'assigned' => true,
                'handled_by' => 'human'
            ]);
        }

        // AI already joined?
        if ($conversation->handled_by === 'ai') {
            return response()->json([
                'assigned' => true,
                'handled_by' => 'ai'
            ]);
        }

        // Still waiting
        $waitUntil = $this->waitUntil($conversation);
        if (now()->lt($waitUntil)) {
            return response()->json([
                'assigned' => false,
                'wait_remaining' => now()->diffInSeconds($waitUntil)
            ]);
        }

        // Expired => join AI
        $this->joinAiAndNotify($conversation);

        return response()->json([
            'assigned' => true,
            'handled_by' => 'ai'
        ]);
    }

    public function resume(Request $request)
    {
        $site = $this->site($request);
        $uuid = $request->query('uuid');

        $conversation = Conversation::where('uuid', $uuid)
            ->where('company_site_id', $site->id)
            ->first();

        if (!$conversation) {
            return response()->json(['valid' => false], 404);
        }

        $messages = $conversation->messages()
            ->orderBy('id')
            ->limit(200)
            ->get()
            ->map(fn ($m) => $this->mapMessage($m));

        return response()->json([
            'valid' => true,
            'status' => $conversation->status,
            'handled_by' => $conversation->handled_by,
            'messages' => $messages,
        ]);
    }

    public function messages(Request $request)
    {
        $site = $this->site($request);
        $uuid = $request->query('uuid');
        $afterId = (int) $request->query('after_id', 0);

        $conversation = Conversation::where('uuid', $uuid)
            ->where('company_site_id', $site->id)
            ->firstOrFail();

        $msgs = $conversation->messages()
            ->where('id', '>', $afterId)
            ->orderBy('id')
            ->get()
            ->map(fn ($m) => $this->mapMessage($m));

        return response()->json(['messages' => $msgs]);
    }

    public function sendMessage(Request $request)
    {
        $site = $this->site($request);

        $request->validate([
            'uuid' => 'required|string',
            'message' => 'required|string|max:3000',
        ]);

        $conversation = Conversation::where('uuid', $request->uuid)
            ->where('company_site_id', $site->id)
            ->where('status', 'open')
            ->firstOrFail();

        // Visitor message => triggers SSE automatically
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'visitor',
            'sender_id' => null,
            'message' => $request->message,
        ]);

        $conversation->refresh();

        // Fallback requirement:
        // If frontend never called checkAssignment(),
        // after 1 minute + on next visitor message => join AI.
        $waitUntil = $this->waitUntil($conversation);

        if (
            empty($conversation->assigned_agent_id)
            && $conversation->handled_by !== 'ai'
            && now()->gte($waitUntil)
        ) {
            $this->joinAiAndNotify($conversation);
            $conversation->refresh();
        }

        // If AI is active => respond async (best performance)
        if ($conversation->handled_by === 'ai') {
            AiRespondToConversationJob::dispatch($conversation->id)
                ->delay(now()->addSeconds(2)); // debounce burst typing
        }

        return response()->json(['ok' => true]);
    }

    public function end(Request $request)
    {
        $site = $this->site($request);

        $request->validate([
            'uuid' => 'required|string',
        ]);

        $conversation = Conversation::where('uuid', $request->uuid)
            ->where('company_site_id', $site->id)
            ->firstOrFail();

        $conversation->update(['status' => 'closed']);

        // System message => triggers SSE update
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'system',
            'sender_id' => null,
            'message' => 'Chat ended by visitor.',
        ]);

        return response()->json(['ok' => true]);
    }

    public function events(Request $request)
    {
        $site = $this->site($request);
        $uuid = $request->query('uuid');
        $lastId = (int) $request->query('last_id', 0);

        $conversation = Conversation::where('uuid', $uuid)
            ->where('company_site_id', $site->id)
            ->firstOrFail();

        return response()->stream(function () use ($conversation, $lastId) {
            $start = time();
            $timeout = 25;
            $sleep = 2;

            while (time() - $start < $timeout) {
                $latest = (int) Cache::get($this->cacheKey($conversation->uuid), 0);

                if ($latest > $lastId) {
                    echo "id: {$latest}\n";
                    echo "event: message\n";
                    echo "data: {\"ok\":true}\n\n";
                    @ob_flush(); @flush();
                    return;
                }

                echo "event: ping\n";
                echo "data: {}\n\n";
                @ob_flush(); @flush();

                sleep($sleep);
            }
        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'Connection' => 'keep-alive',
            'X-Accel-Buffering' => 'no',
        ]);
    }

    private function cacheKey(string $uuid): string
    {
        return "conv:{$uuid}:last_msg_id";
    }

    /**
     * AI join is DB-locked to prevent double "AI joined" messages.
     */
    private function joinAiAndNotify(Conversation $conversation): void
    {
        DB::transaction(function () use ($conversation) {

            $conv = Conversation::whereKey($conversation->id)
                ->lockForUpdate()
                ->first();

            // Human joined? stop.
            if (!empty($conv->assigned_agent_id)) {
                return;
            }

            // AI already joined? stop.
            if ($conv->handled_by === 'ai') {
                return;
            }

            $conv->update([
                'handled_by' => 'ai',
                'ai_started_at' => now(),
                'assigned_at' => now(),
                'assigned_user_id' => 1
            ]);

            // Messages => SSE auto
            Message::create([
                'conversation_id' => $conv->id,
                'sender_type' => 'system',
                'sender_id' => null,
                'message' => 'AI assistant joined the chat.',
            ]);

            Message::create([
                'conversation_id' => $conv->id,
                'sender_type' => 'ai',
                'sender_id' => (int) config('app.ai_agent_id'),
                'message' => "👋 Hi! I’m your AI assistant. All human agents are busy right now, but I can help. What can I assist you with?",
            ]);

            Message::create([
                'conversation_id' => $conv->id,
                'sender_type' => 'system',
                'sender_id' => null,
                'message' => 'We have notified our support staff, they will join shortly.',
            ]);
        });

        // Email notify (throttled)
        $this->notifyCompanyAgentsByEmail($conversation);
    }

    private function notifyCompanyAgentsByEmail(Conversation $conversation): void
    {
        $key = "conv:{$conversation->uuid}:agents_emailed";

        if (!Cache::add($key, 1, now()->addMinutes(10))) {
            return;
        }

        $agents = Agent::where('company_id', $conversation->company_id)
            ->where('is_active', true)
            ->get();

        foreach ($agents as $agent) {
            Mail::to($agent->email)->queue(new ChatWaitingMail($conversation));
        }
    }

    private function mapMessage($m): array
    {
        // AI should look like agent in widget UI
        $from = $m->sender_type === 'visitor'
            ? 'user'
            : (in_array($m->sender_type, ['agent', 'ai']) ? 'agent' : 'system');

        $senderName = $from === 'user'
            ? 'You'
            : ($m->sender_type === 'ai' ? 'AI Assistant' : ($from === 'agent' ? 'Agent' : 'System'));

        return [
            'id' => $m->id,
            'from' => $from,
            'sender_type' => $m->sender_type,
            'sender_name' => $senderName,
            'text' => $m->message,
            'created_at' => optional($m->created_at)->toIso8601String(),
        ];
    }
}