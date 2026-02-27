<?php

namespace App\Http\Controllers\Widget;

use App\Http\Controllers\Controller;

class WidgetScriptController extends Controller
{
    public function script()
    {
        $js = file_get_contents(resource_path('widget/ezead-chat.js'));

        return response($js, 200, [
            'Content-Type' => 'application/javascript; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}