<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;

use App\Http\Controllers\Company\AuthController as CompanyAuth;
use App\Http\Controllers\Company\DashboardController as CompanyDashboard;

use App\Http\Controllers\Agent\AuthController as AgentAuth;
use App\Http\Controllers\Agent\DashboardController as AgentDashboard;

use App\Http\Controllers\Company\SiteController;
use App\Http\Controllers\Company\AgentController;
use App\Http\Controllers\Company\ChatController;

use App\Http\Controllers\Agent\ChatController as AgentChatController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Widget\WidgetScriptController;
use App\Http\Controllers\Agent\AgentEventController;

Route::get('/widget/ezead-chat.js', [WidgetScriptController::class, 'script'])->name('widget.script');


Route::middleware('auth.company')->prefix('company')->group(function () {

    Route::get('sites', [SiteController::class, 'index'])->name('company.sites.index');
    Route::get('sites/create', [SiteController::class, 'create'])->name('company.sites.create');
    Route::post('sites', [SiteController::class, 'store'])->name('company.sites.store');
    Route::delete('sites/{site}', [SiteController::class, 'destroy'])->name('company.sites.destroy');

    Route::get('agents', [AgentController::class, 'index'])->name('company.agents.index');
    Route::get('agents/create', [AgentController::class, 'create'])->name('company.agents.create');
    Route::post('agents', [AgentController::class, 'store'])->name('company.agents.store');
    Route::delete('agents/{agent}', [AgentController::class, 'destroy'])->name('company.agents.destroy');

    Route::get('chats', [ChatController::class, 'index'])->name('company.chats.index');
});

Route::get('/', fn() => redirect()->route('admin.login'));

// ADMIN
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuth::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AdminAuth::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AdminAuth::class, 'logout'])->name('admin.logout');

    Route::middleware('auth.admin')->group(function () {
        Route::get('dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
        Route::get('companies', [CompanyController::class, 'index'])->name('admin.companies.index');
        Route::get('companies/create', [CompanyController::class, 'create'])->name('admin.companies.create');
        Route::post('companies', [CompanyController::class, 'store'])->name('admin.companies.store');
        Route::get('companies/{company}/edit', [CompanyController::class, 'edit'])->name('admin.companies.edit');
        Route::put('companies/{company}', [CompanyController::class, 'update'])->name('admin.companies.update');
        Route::delete('companies/{company}', [CompanyController::class, 'destroy'])->name('admin.companies.destroy');
    });
});

// COMPANY
Route::prefix('company')->group(function () {
    Route::get('login', [CompanyAuth::class, 'showLogin'])->name('company.login');
    Route::post('login', [CompanyAuth::class, 'login'])->name('company.login.submit');
    Route::post('logout', [CompanyAuth::class, 'logout'])->name('company.logout');

    Route::middleware('auth.company')->group(function () {
        Route::get('dashboard', [CompanyDashboard::class, 'index'])->name('company.dashboard');
        // later: sites, agents, chats
    });
});

// AGENT
Route::prefix('agent')->group(function () {
    Route::get('login', [AgentAuth::class, 'showLogin'])->name('agent.login');
    Route::post('login', [AgentAuth::class, 'login'])->name('agent.login.submit');
    Route::post('logout', [AgentAuth::class, 'logout'])->name('agent.logout');

    Route::middleware('auth.agent')->group(function () {
        Route::get('dashboard', [AgentDashboard::class, 'index'])->name('agent.dashboard');
        Route::get('chats', [AgentChatController::class, 'index'])->name('agent.chats.index');
        Route::get('chats/{conversation}', [AgentChatController::class, 'show'])->name('agent.chats.show');
        Route::post('chats/{conversation}/join', [AgentChatController::class, 'join'])->name('agent.chats.join');
        Route::post('chats/{conversation}/reply', [AgentChatController::class, 'reply'])->name('agent.chats.reply');
        Route::post('chats/{conversation}/close', [AgentChatController::class, 'close'])->name('agent.chats.close');
        Route::get('/events', [AgentEventController::class, 'events'])->name('agent.events');
        Route::get('chats/{conversation}/fetch-new', [AgentChatController::class, 'fetchNew'])->name('agent.chats.fetchNew');
        Route::post('chats/{conversation}/leave',
            [AgentChatController::class, 'leave']
        )->name('agent.chats.leave');
    });
});

Route::get('/', function () {
    return view('welcome');
});
