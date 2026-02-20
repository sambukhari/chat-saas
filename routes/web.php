<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CompanySiteController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Agent\DashboardController;
use App\Http\Controllers\App\UserManagementController;
use App\Http\Controllers\Admin\UserRoleController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Auth (Laravel UI)
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    | Dashboard
    */
    Route::get('/dashboard', function () {
        //asign admin role to user
        auth()->user()->syncRoles('super_admin');

        return view('admin.dashboard');
    })->name('admin.dashboard');

    /*
    | Profile
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | Super Admin
    |--------------------------------------------------------------------------
    */

  

    Route::middleware(['role:super_admin'])
        ->prefix('admin')
        ->group(function () {

            Route::get('/', fn () => redirect()->route('admin.companies.index'));

            Route::get('/companies', [CompanyController::class, 'index'])
                ->name('admin.companies.index');

            Route::get('/companies/create', [CompanyController::class, 'create'])
                ->name('admin.companies.create');

            Route::post('/companies', [CompanyController::class, 'store'])
                ->name('admin.companies.store');

            Route::get('/companies/{company}/sites', [CompanySiteController::class, 'index'])
                ->name('admin.sites.index');

            Route::get('/companies/{company}/sites/create', [CompanySiteController::class, 'create'])
                ->name('admin.sites.create');

            Route::post('/companies/{company}/sites', [CompanySiteController::class, 'store'])
                ->name('admin.sites.store');

            Route::get('/roles', [RoleController::class, 'index'])
                ->name('admin.roles.index');

            Route::get('/roles/create', [RoleController::class, 'create'])
                ->name('admin.roles.create');

            Route::post('/roles', [RoleController::class, 'store'])
                ->name('admin.roles.store');
            
            Route::get('/users', [UserRoleController::class, 'index'])
                ->name('admin.users.index');

            Route::get('/users/{user}/roles', [UserRoleController::class, 'edit'])
                ->name('admin.users.roles.edit');

            Route::put('/users/{user}/roles', [UserRoleController::class, 'update'])
                ->name('admin.users.roles.update');
        });


    /*
    |--------------------------------------------------------------------------
    | Company Admin (Agent Management)
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:company_admin'])
        ->prefix('app')
        ->group(function () {

            Route::get('/users', [UserManagementController::class, 'index'])
                ->name('app.users.index');

            Route::get('/users/create', [UserManagementController::class, 'create'])
                ->name('app.users.create');

            Route::post('/users', [UserManagementController::class, 'store'])
                ->name('app.users.store');

            Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])
                ->name('app.users.edit');

            Route::put('/users/{user}', [UserManagementController::class, 'update'])
                ->name('app.users.update');

            Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])
                ->name('app.users.destroy');
        });


    /*
    |--------------------------------------------------------------------------
    | Agent Dashboard
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:company_admin,agent'])
        ->prefix('agent')
        ->group(function () {

            Route::get('/', [DashboardController::class, 'index'])
                ->name('agent.dashboard');

            Route::get('/chats', [DashboardController::class, 'chats'])
                ->name('agent.chats');

            Route::get('/messages/{uuid}', [DashboardController::class, 'messages'])
                ->name('agent.messages');

            Route::post('/join', [DashboardController::class, 'join'])
                ->name('agent.join');

            Route::post('/send', [DashboardController::class, 'send'])
                ->name('agent.send');

            Route::post('/close', [DashboardController::class, 'close'])
                ->name('agent.close');
        });

});