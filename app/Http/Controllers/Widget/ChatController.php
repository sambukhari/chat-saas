<?php

namespace App\Http\Controllers\Widget;

use App\Http\Controllers\Controller;
use App\Models\CompanySite;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\SupportEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ChatController extends Controller
{
    protected function validateWidget(Request $request)
    {
        $site = CompanySite::where('widget_key', $request->header('X-WIDGET-KEY'))
            ->where('is_active', true)
            ->firstOrFail();

        return $site;
    }

    public function start(Request $request)
    {
        $site = $this->validateWidget($request);

        $conversation = Conversation::create([
            'uuid' => Str::uuid(),
            'company_id' => $site->company_id,
            'site_id' => $site->id,
            'visitor_name' => $request->name,
            'visitor_email' => $request->email,
            'status' => 'open'
        ]);

        SupportEvent::create([
            'company_id' => $site->company_id,
            'conversation_id' => $conversation->id,
            'type' => 'conversation_created',
            'payload' => ['uuid' => $conversation->uuid]
        ]);

        return response()->json(['uuid' => $conversation->uuid]);
    }

    public function send(Request $request)
    {
        $site = $this->validateWidget($request);

        $conversation = Conversation::where('uuid', $request->uuid)
            ->where('company_id', $site->company_id)
            ->firstOrFail();

        $message = Message::create([
            'company_id' => $site->company_id,
            'conversation_id' => $conversation->id,
            'sender_type' => 'visitor',
            'text' => $request->message
        ]);

        $conversation->increment('unread_count');

        SupportEvent::create([
            'company_id' => $site->company_id,
            'conversation_id' => $conversation->id,
            'type' => 'message',
            'payload' => [
                'uuid' => $conversation->uuid,
                'text' => $message->text
            ]
        ]);

        return response()->json(['status' => 'ok']);
    }
}