<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;

class DashboardController extends Controller
{
    public function index()
    {
        $agentId = Auth::guard('agent')->id();
        $companyId = Auth::guard('agent')->user()->company_id;

        return view('agent.dashboard', [
            'myOpen' => Conversation::where('company_id',$companyId)->where('assigned_agent_id',$agentId)->where('status','open')->count(),
            'unassignedOpen' => Conversation::where('company_id',$companyId)->whereNull('assigned_agent_id')->where('status','open')->count(),
        ]);
    }
}