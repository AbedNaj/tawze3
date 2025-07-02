<?php

use App\Http\Controllers\SuperAdmin\Auth\LoginController;
use App\Http\Controllers\SuperAdmin\CompanyController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {

        Route::controller(LoginController::class)->middleware('guest:web')->group(function () {

            Route::get('/login', 'index')->name('login');
            Route::post('/login', 'store')->name('login.store');
        });

        Route::middleware(['auth:web'])->group(function () {


            Route::controller(DashboardController::class)->group(function () {

                Route::get('/dashboard', 'index')->name('dashboard.index');
            });

            Route::controller(CompanyController::class)->group(function () {

                Route::get('/company', 'index')->name('company.index');

                Route::get('/create/company', 'create')->name('company.create');
                Route::post('/create/company', 'store')->name('company.store');
            });
        });
    });
}
