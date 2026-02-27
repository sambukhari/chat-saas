<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AgentEventController extends Controller
{
    public function events(Request $request)
    {
        $agent = Auth::guard('agent')->user();
        $companyId = $agent->company_id;

        $lastId = (int) $request->query('last_id', 0);

        return response()->stream(function () use ($companyId, $lastId) {

            $start = time();
            $timeout = 25;
            $sleep = 2;

            while (time() - $start < $timeout) {

                $latest = (int) Cache::get("company:{$companyId}:last_event_id", 0);

                if ($latest > $lastId) {
                    echo "id: {$latest}\n";
                    echo "event: company_message\n";
                    echo "data: {\"ok\":true}\n\n";
                    @ob_flush(); @flush();
                    return;
                }

                echo "event: ping\n";
                echo "data: {}\n\n";
                @ob_flush(); @flush();
                sleep($sleep);
            }

        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'Connection' => 'keep-alive',
            'X-Accel-Buffering' => 'no',
        ]);
    }
}