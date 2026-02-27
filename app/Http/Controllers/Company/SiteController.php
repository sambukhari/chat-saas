<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanySite;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    public function index()
    {
        $companyId = Auth::guard('company')->id();

        $sites = CompanySite::where('company_id', $companyId)->latest()->get();

        return view('company.sites.index', compact('sites'));
    }

    public function create()
    {
        return view('company.sites.create');
    }

    public function store(Request $request)
    {
        $companyId = Auth::guard('company')->id();

        $request->validate([
            'domain' => 'required|string'
        ]);

        CompanySite::create([
            'company_id' => $companyId,
            'domain' => $request->domain,
            'widget_key' => Str::uuid(),
            'is_active' => true
        ]);

        return redirect()->route('company.sites.index');
    }

    public function destroy(CompanySite $site)
    {
        $companyId = Auth::guard('company')->id();

        if ($site->company_id != $companyId) abort(403);

        $site->delete();

        return back();
    }
}