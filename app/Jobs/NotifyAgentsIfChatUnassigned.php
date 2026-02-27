<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\User;
use App\Models\Conversation;


class NotifyAgentsIfChatUnassigned implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $conversation = Conversation::find($this->conversationId);

        if (!$conversation) return;

        if (!$conversation->assigned_user_id) {
            // notify all company agents
            $agents = User::role('agent')
                ->where('company_id', $conversation->company_id)
                ->get();

            foreach ($agents as $agent) {
                Mail::to($agent->email)->queue(
                    new ChatWaitingMail($conversation)
                );
            }
        }
    }
}
