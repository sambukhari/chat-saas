<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;

class DashboardController extends Controller
{
    public function index()
    {
        $companyId = Auth::guard('company')->id();

        return view('company.dashboard', [
            'openConversations' => Conversation::where('company_id', $companyId)->where('status','open')->count(),
            'closedConversations' => Conversation::where('company_id', $companyId)->where('status','closed')->count(),
        ]);
    }
}
