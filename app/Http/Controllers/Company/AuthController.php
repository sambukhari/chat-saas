<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('company.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('company')->attempt($request->only('email','password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('company.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('company')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('company.login');
    }
}