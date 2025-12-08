<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SaleStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Tenants\Customer;
use App\Models\Tenants\Sale;
use App\Http\Requests\Admin\Sale\StoreSaleRequest;
use App\Http\Requests\Admin\Sale\UpdateSaleRequest;
use App\Models\Tenants\Employee;
use App\Models\Tenants\ProductType;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.sale.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastSale = Sale::orderBy('created_at', 'desc')
            ->where('user_id', '=', Auth::guard('admin')->user()->id)->first();

        $employees = Employee::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');
        $productTypes = ProductType::select('id', 'name')->get();

        if ($lastSale && $lastSale['status'] === SaleStatusEnum::DRAFT->value) {

            return redirect()->route('admin.sales.show', [
                'sale' => $lastSale,
                'employees' => $employees,
                'customers' => $customers,

            ]);
        } else {
            $sale = Sale::create([
                'price' => 0,
                'user_id' => Auth::guard('admin')->user()->id,
                'invoice_date' => now(),
            ]);

            return redirect()->route('admin.sales.show', [
                'sale' => $sale->id,
                'employees' => $employees,
                'customers' => $customers,
                'productTypes' => $productTypes,
            ]);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $employees = Employee::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');
        $productTypes = ProductType::pluck('name', 'id');

        return view('admin.pages.sale.show', [
            'sale' => $sale,
            'employees' => $employees,
            'customers' => $customers,
            'productTypes' => $productTypes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
