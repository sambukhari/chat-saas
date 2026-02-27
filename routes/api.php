<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Widget\WidgetChatController;


Route::prefix('widget')->middleware('widget.site')->group(function () {
    Route::get('validate', [WidgetChatController::class, 'validateKey']);
    Route::post('start', [WidgetChatController::class, 'start']);
    Route::post('message', [WidgetChatController::class, 'sendMessage']);
    Route::post('end', [WidgetChatController::class, 'end']);
    Route::get('resume', [WidgetChatController::class, 'resume']);
    Route::get('messages', [WidgetChatController::class, 'messages']);
    Route::get('events', [WidgetChatController::class, 'events']);
    Route::post('check-assignment', [WidgetChatController::class, 'checkAssignment']);
});