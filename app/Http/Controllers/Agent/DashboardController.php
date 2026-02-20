<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('agent.dashboard');
    }

    public function chats()
    {
        $companyId = auth()->user()->company_id;

        $chats = Conversation::where('company_id', $companyId)
            ->where('status', 'open')
            ->latest()
            ->get();

        return response()->json($chats);
    }

    public function messages($uuid)
    {
        $conversation = Conversation::where('uuid', $uuid)
            ->where('company_id', auth()->user()->company_id)
            ->firstOrFail();

        return response()->json($conversation->messages()->latest()->get());
    }

    public function join(Request $request)
    {
        $conversation = Conversation::where('uuid', $request->uuid)
            ->where('company_id', auth()->user()->company_id)
            ->firstOrFail();

        if ($conversation->assigned_agent_id &&
            $conversation->assigned_agent_id !== auth()->id()) {

            return response()->json(['error' => 'Already assigned'], 403);
        }

        $conversation->update([
            'assigned_agent_id' => auth()->id()
        ]);

        return response()->json(['status' => 'joined']);
    }

    public function send(Request $request)
    {
        $conversation = Conversation::where('uuid', $request->uuid)
            ->where('company_id', auth()->user()->company_id)
            ->firstOrFail();

        if ($conversation->assigned_agent_id !== auth()->id()) {
            return response()->json(['error' => 'You must join first'], 403);
        }

        $message = Message::create([
            'company_id' => auth()->user()->company_id,
            'conversation_id' => $conversation->id,
            'sender_type' => 'agent',
            'sender_id' => auth()->id(),
            'text' => $request->message
        ]);

        $conversation->update(['unread_count' => 0]);

        return response()->json(['status' => 'sent']);
    }

    public function close(Request $request)
    {
        $conversation = Conversation::where('uuid', $request->uuid)
            ->where('company_id', auth()->user()->company_id)
            ->firstOrFail();

        $conversation->update([
            'status' => 'closed'
        ]);

        return response()->json(['status' => 'closed']);
    }
}