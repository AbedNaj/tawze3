<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EmployeeUserController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductTypeController;
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

            Route::controller(ProductTypeController::class)->group(function () {

                Route::get('product-types', 'index')->name('product-types.index');

                Route::get('product-types/create', 'create')->name('product-types.create');

                Route::post('product-types/create', 'store')->name('product-types.store');

                Route::get('product-types/{id}/show', 'show')->name('product-types.show');

                Route::patch('product-types/{id}/update', 'update')->name('product-types.update');

                Route::delete('product-types/{id}/delete', 'destroy')->name('product-types.delete');
            });

            Route::controller(ProductController::class)->group(function () {

                Route::get('products', 'index')->name('products.index');

                Route::get('products/create', 'create')->name('products.create');

                Route::post('products/create', 'store')->name('products.store');

                Route::get('products/{product}/show', 'show')->name('products.show');

                Route::patch('products/{product}/update', 'update')->name('products.update');

                Route::delete('products/{product}/delete', 'destroy')->name('products.delete');

                Route::get('products/product-entry-method', 'productEntry')->name('products.product-entry-method');
            });


            Route::controller(InventoryController::class)->group(function () {

                Route::get('inventory', 'index')->name('inventory.index');

                Route::get('inventory/{inventory}/show', 'show')->name('inventory.show');

                Route::patch('inventory/{inventory}/update', 'update')->name('inventory.update');
            });



            Route::controller(EmployeeController::class)->group(function () {

                Route::get('employees', 'index')->name('employees.index');

                Route::get('employees/create', 'create')->name('employees.create');

                Route::post('employees/create', 'store')->name('employees.store');

                Route::get('employees/{employee}/show', 'show')->name('employees.show');

                Route::patch('employees/{employee}/update', 'update')->name('employees.update');

                Route::delete('employees/{employee}/delete', 'destroy')->name('employees.delete');
            });


            Route::controller(EmployeeUserController::class)->group(function () {



                Route::get('employeeUser/{employeeUser}/show', 'show')->name('employeeUser.show');

                Route::patch('employeeUser/{employeeUser}/update', 'update')->name('employeeUser.update');
                Route::patch('employeeUser/{employeeUser}/update-password', 'updatePassword')->name('employeeUser.update-password');
            });
        });
    });
});
