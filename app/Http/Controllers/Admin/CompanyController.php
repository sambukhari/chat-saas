<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(20);
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'plan' => ['required','in:free,pro,enterprise'],
            'ai_enabled' => ['nullable','boolean'],

            // company admin
            'admin_name' => ['required','string','max:255'],
            'admin_email' => ['required','email','max:255','unique:users,email'],
            'admin_password' => ['required','string','min:8'],
        ]);

        $company = Company::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']).'-'.Str::lower(Str::random(6)),
            'plan' => $data['plan'],
            'ai_enabled' => (bool)($data['ai_enabled'] ?? false),
            'is_active' => true,
        ]);

        User::create([
            'name' => $data['admin_name'],
            'email' => $data['admin_email'],
            'password' => Hash::make($data['admin_password']),
            'role' => 'company_admin',
            'company_id' => $company->id,
        ]);

        return redirect()->route('admin.companies.index')->with('success', 'Company created');
    }
}