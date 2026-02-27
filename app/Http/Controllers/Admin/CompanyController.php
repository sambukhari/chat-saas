<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:companies',
            'password' => 'required|min:6',
            'plan' => 'required|string'
        ]);

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'plan' => $request->plan,
            'is_active' => true
        ]);

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company created successfully.');
    }

    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:companies,email,' . $company->id,
            'plan' => 'required|string'
        ]);

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'plan' => $request->plan,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('admin.companies.index')->with('success', 'Company deleted successfully.');
    }
}