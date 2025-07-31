<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Tenants\PaymentMethod;
use App\Http\Requests\Admin\Sale\StorePaymentMethodRequest;
use App\Http\Requests\Admin\Sale\UpdatePaymentMethodRequest;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.paymentMethod.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.paymentMethod.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentMethodRequest $request)
    {
        $validated = $request->validated();

        PaymentMethod::create($validated);

        return redirect()->route('admin.paymentMethods.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {

        return view(
            'admin.pages.paymentMethod.show',
            [
                'PaymentMethod' => $paymentMethod
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $validated = $request->validated();
        $paymentMethod->fill([
            'name' => $validated['name']
        ]);

        if ($paymentMethod->isDirty()) {
            $paymentMethod->save();
            return back()->with('status', 'تم التعديل بنجاح');
        }
        return back()->with('info', 'لم يتم إجراء أي تعديل');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->delete()) {
            return redirect()->route('admin.paymentMethods.index')->with([
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
