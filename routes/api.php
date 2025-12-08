<?php

use App\Http\Controllers\SuperAdmin\Auth\LoginController;
use App\Http\Controllers\SuperAdmin\CompanyController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use Illuminate\Support\Facades\Route;

use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;



// Temporary auth setup — will be replaced with proper protection later.


Route::middleware(
    [
        InitializeTenancyByDomain::class,
        PreventAccessFromCentralDomains::class,
        'auth:admin',
        'web'
    ]
)->group(function () {

    Route::prefix('v1')->name('api.v1.')->group(function () {
        Route::get('/customers', [\App\Http\Controllers\Api\V1\Customers\CustomersController::class, '__invoke'])->name('customers');

        Route::get('/employees', [\App\Http\Controllers\Api\V1\Employees\EmployeeController::class, '__invoke'])->name('employees');

        Route::get('/locations', [\App\Http\Controllers\Api\V1\Locations\LocationController::class, '__invoke'])->name('locations');
    });
});
