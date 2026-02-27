<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\CompanySite;

class ResolveWidgetSite
{
    public function handle(Request $request, Closure $next)
    {
        $key = $request->query('key') ?: $request->header('X-Widget-Key');

        if (!$key) {
            return response()->json(['error' => 'Missing widget key'], 401);
        }

        $site = CompanySite::where('widget_key', $key)->where('is_active', 1)->first();
        if (!$site) {
            return response()->json(['error' => 'Invalid widget key'], 401);
        }

        // Domain lock: allow only the site domain to use its widget_key
        $origin = $request->headers->get('origin') ?: $request->headers->get('referer');
        $host = $origin ? parse_url($origin, PHP_URL_HOST) : null;

        if (!$host) {
            return response()->json(['error' => 'Origin missing'], 403);
        }

        // Basic match: allow exact or subdomain of saved domain
        $allowed = $site->domain; // e.g. example.com
        $host = strtolower($host);
        $allowed = strtolower($allowed);

        $isAllowed =
            $host === $allowed ||
            str_ends_with($host, '.' . $allowed);

        if (!$isAllowed) {
            return response()->json(['error' => 'Domain not allowed'], 403);
        }

        // Attach resolved site to request
        $request->attributes->set('company_site', $site);

        return $next($request);
    }
}