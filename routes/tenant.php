<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EmployeeUserController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\WareHouseController;
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


            // Product Types
            Route::resource('product-types', ProductTypeController::class)->names('product-types');


            // Product

            Route::controller(ProductController::class)->group(function () {

                Route::get('products/product-entry-method', 'productEntry')->name('products.product-entry-method');
            });


            Route::resource('products', ProductController::class)->names('products')->except(['edit']);


            // Inventory

            Route::controller(InventoryController::class)->group(function () {

                Route::patch('restock/{inventory}', 'restock')->name('restock.store');
                Route::get('employee-inventory/transfer', 'transfer')->name('inventory.transfer');
                Route::post('inventory/transfer', 'transterUpdate')->name('inventory.transterUpdate');
            });

            Route::resource('inventory', InventoryController::class)->names('inventory')->except(['create', 'store', 'edit']);



            // Employee

            Route::resource('employees', EmployeeController::class)->names('employees')->except(['edit']);


            Route::controller(EmployeeUserController::class)->group(function () {

                Route::get('employeeUser/{employeeUser}/show', 'show')->name('employeeUser.show');

                Route::patch('employeeUser/{employeeUser}/update', 'update')->name('employeeUser.update');
                Route::patch('employeeUser/{employeeUser}/update-password', 'updatePassword')->name('employeeUser.update-password');
            });


            // Location

            Route::resource('locations', LocationController::class)->names('locations')->except(['edit']);


            // Customer 

            Route::resource('customers', CustomerController::class)->names('customers')->except(['edit']);


            // Payment Method

            Route::resource('payment-methods', PaymentMethodController::class)->names('paymentMethods')->except(['edit']);


            // sales 

            Route::resource('sales', SaleController::class)->names('sales')->except(['edit']);

            // ware house

            Route::resource('ware-houses', WareHouseController::class)->names('ware-houses')->except(['edit']);
        });
    });
});
