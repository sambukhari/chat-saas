<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotCompany
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('company')->check()) {
            return redirect()->route('company.login');
        }
        return $next($request);
    }
}