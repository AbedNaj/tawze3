<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tenants\Customer;
use App\Http\Requests\Admin\Customer\StoreCustomerRequest;
use App\Http\Requests\Admin\Customer\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use App\Models\Tenants\Location;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $locations = Location::orderByRaw('name')->pluck('name', 'id');
        return view('admin.pages.customer.create', [
            'locations' => $locations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $validated = $request->validated();

        Customer::create(
            [
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'location_id' => $validated['location_id'],
                'address' => $validated['address']
            ]
        );

        return redirect()->route('admin.customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {

        $customer->load('location:id,name');
        $locations = Location::orderByRaw('name')->pluck('name', 'id');
        $sales = [];
        return view('admin.pages.customer.show', [
            'customer' => $customer,
            'locations' => $locations,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $validated = $request->validated();

        $customer->fill(
            [
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'location_id' => $validated['location_id'],
                'address' => $validated['address']
            ]
        );

        if ($customer->isDirty()) {
            $customer->save();
            return back()->with('status', 'تم التعديل بنجاح');
        }
        return back()->with('info', 'لم يتم إجراء أي تعديل');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if ($customer->delete()) {
            return redirect()->route('admin.customers.index')->with([
                'message' => 'Product Type deleted successfully.',
                'alert-type' => 'success'
            ]);
        }

        return back()->with([
            'message' => 'Failed to delete Product Type.',
            'alert-type' => 'error'
        ]);
    }
}
