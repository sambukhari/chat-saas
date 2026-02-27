<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Message extends Model
{
    protected $fillable = ['conversation_id','sender_type','sender_id','message'];

    public function conversation() { return $this->belongsTo(Conversation::class); }

    protected static function booted()
    {    
        static::created(function ($message) {

            $conversation = $message->conversation;
            if (!$conversation) return;
            // 1) Bump conversation last msg (widget SSE)
            Cache::put("conv:{$conversation->uuid}:last_msg_id", $message->id, now()->addHours(8));
            // 2) Bump company event stream for agents (agent SSE)
            Cache::put("company:{$conversation->company_id}:last_event_id", $message->id, now()->addHours(8));
        });
    }
}
