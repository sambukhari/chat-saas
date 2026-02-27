<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;

class ChatController extends Controller
{
    public function index()
    {
        $companyId = Auth::guard('company')->id();

        $conversations = Conversation::where('company_id', $companyId)
            ->latest()
            ->get();

        return view('company.chats.index', compact('conversations'));
    }
}