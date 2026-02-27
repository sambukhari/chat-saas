<?php

namespace App\Http\Controllers\Widget;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Models\Conversation;
use App\Models\Message;
use App\Helpers\AgentPresence;

class WidgetChatController extends Controller
{
    private function site(Request $request)
    {
        return $request->attributes->get('company_site');
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
            'uuid' => Str::uuid(),
            'company_id' => $site->company_id,
            'company_site_id' => $site->id,
            'status' => 'open',
            'visitor_name' => $request->name,
            'visitor_email' => $request->email,
            'human_wait_expired_at' => now()->addMinutes(2),
        ]);

        // optional system msg
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'system',
            'sender_id' => null,
            'message' => 'Chat started. A support agent will join shortly.',
        ]);

        $this->bumpConversation($conversation->uuid);

        return response()->json([
            'uuid' => $conversation->uuid,
            'agents_online' => $onlineAgents->isNotEmpty(),
            'wait_until' => $conversation->human_wait_expired_at,
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

        // If human already joined
        if ($conversation->assigned_user_id && $conversation->handled_by === 'human') {
            return response()->json([
                'assigned' => true,
                'handled_by' => 'human'
            ]);
        }

        // If AI already joined
        if ($conversation->handled_by === 'ai') {
            return response()->json([
                'assigned' => true,
                'handled_by' => 'ai'
            ]);
        }

        // Wait not expired yet
        if (now()->lt($conversation->human_wait_expired_at)) {
            return response()->json([
                'assigned' => false,
                'wait_remaining' => now()->diffInSeconds($conversation->human_wait_expired_at)
            ]);
        }

        // ⛔ 2 minutes expired — escalate
        $this->escalateToAiAndNotify($conversation);

        return response()->json([
            'assigned' => true,
            'handled_by' => 'ai'
        ]);
    }

    protected function escalateToAiAndNotify(Conversation $conversation)
    {
        if ($conversation->assigned_user_id) {
            return; // double safety
        }

        // 1️⃣ Send emails to company agents
        $agents = User::role('agent')
            ->where('company_id', $conversation->company_id)
            ->get();

        foreach ($agents as $agent) {
            Mail::to($agent->email)
                ->queue(new ChatWaitingMail($conversation));
        }

        // 2️⃣ Assign AI
        $conversation->update([
            'assigned_user_id' => 1,
            'handled_by' => 'ai',
            'ai_started_at' => now(),
            'status' => 'assigned',
        ]);

        // 3️⃣ Add system message
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'system',
            'message' => 'All agents are busy. AI assistant joined.',
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'ai',
            'sender_id' => config('app.ai_agent_id'),
            'message' => "Hi! I'm your AI assistant. How can I help?",
        ]);

        // 4️⃣ Create event
        ConversationEvent::create([
            'conversation_id' => $conversation->id,
            'conversation_uuid' => $conversation->uuid,
            'type' => 'assignment',
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

        $msg = Message::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'visitor',
            'sender_id' => null,
            'message' => $request->message,
        ]);

        $this->bumpConversation($conversation->uuid, $msg->id);

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

        $msg = Message::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'system',
            'sender_id' => null,
            'message' => 'Chat ended by visitor.',
        ]);

        $this->bumpConversation($conversation->uuid, $msg->id);

        return response()->json(['ok' => true]);
    }

    /**
     * SSE endpoint:
     * We do "notify-only SSE" exactly like your current widget:
     * When server detects a newer message id than last_id, it emits event,
     * then client calls /messages to fetch actual content.
     */
    public function events(Request $request)
    {
        $site = $this->site($request);
        $uuid = $request->query('uuid');
        $lastId = (int) $request->query('last_id', 0);

        $conversation = Conversation::where('uuid', $uuid)
            ->where('company_site_id', $site->id)
            ->firstOrFail();

        $response = response()->stream(function () use ($conversation, $lastId) {
            $start = time();
            $timeout = 25;      // keep short, browser reconnects
            $sleep = 2;

            while (time() - $start < $timeout) {
                $latest = (int) Cache::get($this->cacheKey($conversation->uuid), 0);

                if ($latest > $lastId) {
                    // SSE format
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

        return $response;
    }

    private function cacheKey(string $uuid): string
    {
        return "conv:{$uuid}:last_msg_id";
    }

    private function bumpConversation(string $uuid, ?int $msgId = null): void
    {
        if ($msgId) {
            Cache::put($this->cacheKey($uuid), $msgId, now()->addHours(8));
            return;
        }

        // fallback if needed
        Cache::put($this->cacheKey($uuid), Cache::get($this->cacheKey($uuid), 0) + 1, now()->addHours(8));
    }

    private function mapMessage($m): array
    {
        // map to your widget expectation
        $from =
            $m->sender_type === 'visitor' ? 'user' :
            ($m->sender_type === 'agent' ? 'agent' : 'system');

        return [
            'id' => $m->id,
            'from' => $from,
            'sender_type' => $m->sender_type, // visitor/agent/system/ai
            'sender_name' => $from === 'user' ? 'You' : ($from === 'agent' ? 'Agent' : 'System'),
            'text' => $m->message,
            'created_at' => optional($m->created_at)->toIso8601String(),
        ];
    }
}