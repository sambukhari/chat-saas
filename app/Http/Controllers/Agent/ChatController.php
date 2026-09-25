<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\CompanySite;
use App\Models\Message;

class ChatController extends Controller
{
   public function index(Request $request)
    {
        $agent = Auth::guard('agent')->user();
        $status = $request->get('status', 'open');
        $siteId = $request->get('site');
        $site = CompanySite::find($siteId);

        $query = Conversation::where('company_id', $agent->company_id)
            ->where('status', $status);

        if ($siteId) {
            $query->where('company_site_id', $siteId);
        }

        $conversations = $query
            ->withCount([
                'messages as unread_count' => function ($q) {
                    $q->where('sender_type', 'visitor')
                    ->where('is_read', false);
                }
            ])
            ->latest()
            ->get();


        $unreadQuery = Conversation::where('company_id', $agent->company_id)
            ->where('status', 'open');

        if ($siteId) {
            $unreadQuery->where('company_site_id', $siteId);
        }

        $totalUnread = $unreadQuery
            ->withCount([
                'messages as unread_count' => function ($q) {
                    $q->where('sender_type', 'visitor')
                    ->where('is_read', false);
                }
            ])
            ->get()
            ->sum('unread_count');


        return view('agent.chats.index', compact(
            'conversations',
            'status',
            'totalUnread',
            'siteId',
            'site'
        ));
    }
    public function leave(Conversation $conversation)
    {
        $agent = Auth::guard('agent')->user();

        if ($conversation->company_id != $agent->company_id) abort(403);

        if ($conversation->assigned_agent_id == $agent->id) {
            $conversation->update([
                'assigned_agent_id' => null
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function fetchNew(Conversation $conversation)
    {
        $agent = Auth::guard('agent')->user();

        if ($conversation->company_id != $agent->company_id) abort(403);

        $afterId = request('after_id', 0);

        $messages = $conversation->messages()
            ->where('id', '>', $afterId)
            ->orderBy('id')
            ->get()
            ->map(function ($m) {
                return [
                    'id' => $m->id,
                    'sender_type' => $m->sender_type,
                    'message' => $m->message,
                    'created_at' => $m->created_at,
                ];
            });

        return response()->json([
            'messages' => $messages
        ]);
    }

    public function show(Conversation $conversation)
    {
        $agent = Auth::guard('agent')->user();

        if ($conversation->company_id != $agent->company_id) abort(403);

        $conversation->load('messages');
        $conversation->messages()
            ->where('sender_type', 'visitor')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('agent.chats.show', compact('conversation'));
    }

    public function join(Conversation $conversation)
    {
        $agent = Auth::guard('agent')->user();
        if ($conversation->company_id != $agent->company_id) abort(403);

        $conversation->update([
            'assigned_agent_id' => $agent->id,
            'handled_by' => 'human',
            'assigned_at' => now(),
            'assigned_user_id' => null,
            'ai_started_at' => null,
        ]);

        // Optional: tell visitor that human joined (also triggers SSE)
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'system',
            'sender_id' => null,
            'message' => 'A human support agent joined the chat.',
        ]);

        return back();
    }

    public function reply(Request $request, Conversation $conversation)
    {
        $agent = Auth::guard('agent')->user();

        if ($conversation->company_id != $agent->company_id) abort(403);

        if ($conversation->assigned_agent_id != $agent->id) {
            return response()->json(['error' => 'Join first'], 403);
        }

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'agent',
            'sender_id' => $agent->id,
            'message' => $request->message
        ]);

        return response()->json(['success' => true]);
    }

    public function close(Conversation $conversation)
    {
        $agent = Auth::guard('agent')->user();

        if ($conversation->company_id != $agent->company_id) abort(403);

        $conversation->update(['status' => 'closed']);

        return back();
    }
}