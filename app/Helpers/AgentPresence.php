<?php
namespace App\Helpers;

use App\Models\Agent;
use Illuminate\Support\Facades\Cache;

class AgentPresence
{
    public static function onlineAgents($companyId)
    {
        return Agent::where('company_id', $companyId)
            ->get()
            ->filter(function ($user) {
                return Cache::has("agent_online_{$user->id}");
            });
    }
}