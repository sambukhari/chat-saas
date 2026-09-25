<?php

namespace App\Jobs;

use App\Models\Conversation;
use App\Models\Message;
use App\Services\AiSupportAgent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class AiRespondToConversationJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $conversationId;

    public int $uniqueFor = 120;

    public function __construct(int $conversationId)
    {
        $this->conversationId = $conversationId;

        // ✅ Correct way to assign queue
        $this->onQueue('ai');
    }

    public function uniqueId(): string
    {
        return "ai:conv:{$this->conversationId}";
    }

    public function handle(AiSupportAgent $ai): void
    {
        $lock = Cache::lock("lock:ai:conv:{$this->conversationId}", 90);

        if (! $lock->get()) {
            return;
        }

        try {
            $conv = Conversation::find($this->conversationId);
            if (! $conv) return;

            if (! $ai->canRespond($conv)) return;

            $latestVisitor = Message::where('conversation_id', $conv->id)
                ->where('sender_type', 'visitor')
                ->orderByDesc('id')
                ->first();

            if (! $latestVisitor) return;

            $latestAiId = (int) Message::where('conversation_id', $conv->id)
                ->where('sender_type', 'ai')
                ->max('id');

            if ($latestAiId > (int) $latestVisitor->id) {
                return;
            }

            $ai->respond($conv, (string) $latestVisitor->message);

        } finally {
            optional($lock)->release();
        }
    }
}