<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;
use App\Mail\AgentCredentialsMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AgentController extends Controller
{
    public function index()
    {
        $companyId = Auth::guard('company')->id();

        $agents = Agent::where('company_id', $companyId)->get();

        return view('company.agents.index', compact('agents'));
    }

    public function create()
    {
        return view('company.agents.create');
    }

    public function store(Request $request)
    {
        $companyId = Auth::guard('company')->id();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:agents',
            'password' => 'required|min:6'
        ]);

        $plainPassword = $request->password;

        $agent = Agent::create([
            'company_id' => $companyId,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($plainPassword),
            'is_active' => true
        ]);

        try {
            Mail::to($agent->email)->send(
                new AgentCredentialsMail($agent, $plainPassword)
            );

            if (count(Mail::failures()) > 0) {
                return back()->with('error', 'Email failed to send.');
            }

            return back()->with('success', 'Agent created and email sent.');

        } catch (\Exception $e) {
            return back()->with('error', 'Mail error: '.$e->getMessage());
        }
    }

    public function destroy(Agent $agent)
    {
        $companyId = Auth::guard('company')->id();

        if ($agent->company_id != $companyId) abort(403);

        $agent->delete();

        return back();
    }
}