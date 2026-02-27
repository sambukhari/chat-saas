<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'companiesCount' => Company::count(),
        ]);
    }
}