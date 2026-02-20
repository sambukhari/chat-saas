<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\PermissionRegistrar;

class SetPermissionTeam
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {

            $teamId = auth()->user()->company_id;

            app(PermissionRegistrar::class)
                ->setPermissionsTeamId($teamId);
        }

        return $next($request);
    }
}