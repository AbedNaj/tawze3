<?php

namespace App\Http\Controllers\Api\V1\Customers;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function __invoke(Request $request)
    {
        return Customer::query()
            ->select('id', 'name')
            ->when(
                $request->search,
                fn(Builder $query) => $query
                    ->where('name', 'like', "%{$request->search}%")
            )
            ->orderBy('name')
            ->get();
    }
}
