<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanySite;
use Illuminate\Http\Request;

class CompanySiteController extends Controller
{
    public function index(Company $company)
    {
        $sites = $company->sites;
        return view('admin.sites.index', compact('company','sites'));
    }

    public function create(Company $company)
    {
        return view('admin.sites.create', compact('company'));
    }

    public function store(Request $request, Company $company)
    {
        $request->validate([
            'domain' => 'required|string|max:255'
        ]);

        $company->sites()->create([
            'domain' => $request->domain,
            'is_active' => true
        ]);

        return redirect()->route('admin.sites.index', $company);
    }
}