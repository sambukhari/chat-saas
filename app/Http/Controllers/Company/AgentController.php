<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;

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

        Agent::create([
            'company_id' => $companyId,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => true
        ]);

        return redirect()->route('company.agents.index');
    }

    public function destroy(Agent $agent)
    {
        $companyId = Auth::guard('company')->id();

        if ($agent->company_id != $companyId) abort(403);

        $agent->delete();

        return back();
    }
}