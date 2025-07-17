<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenants\EmployeeInventory;
use App\Http\Requests\Admin\Employee\StoreEmployeeInventoryRequest;
use App\Http\Requests\Admin\Employee\UpdateEmployeeInventoryRequest;
use App\Models\Tenants\Employee;

class EmployeeInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.employeeInventory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeInventoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeInventory $employeeInventory)
    {
        $employeeInventory->load(['product:id,name,product_type_id', 'employee:id,name']);
        return view(
            'admin.pages.employeeInventory.show',
            [
                'employeeInventory' => $employeeInventory
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeInventory $employeeInventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeInventoryRequest $request, EmployeeInventory $employeeInventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeInventory $employeeInventory)
    {
        //
    }
}
