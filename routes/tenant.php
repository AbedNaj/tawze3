<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\RedirectIfNotAdmin;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {

        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::prefix('admin/')->name('admin.')->group(function () {

        Route::middleware(['guest:admin'])->group(function () {
            Route::controller(LoginController::class)->group(function () {

                Route::get('login', 'index')->name('login');
                Route::post('login', 'store')->name('login.store');
            });
        });


        Route::middleware([RedirectIfNotAdmin::class])->group(function () {
            Route::controller(DashboardController::class)->group(function () {

                Route::get('dashbaord', 'index')->name('dashboard');
            });
        });
    });
});
