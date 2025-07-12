<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Product;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Tenants\ProductType;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.product.index');
    }


    public function create()
    {

        $productTypes = ProductType::pluck('name', 'id');


        return view('admin.pages.product.create', [
            'productTypes' => $productTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product =   Product::create(
            [
                'name' => $validated['name'],
                'price' => $validated['price'],
                'qr_code' => $validated['qr_code'] ?? null,
                'product_type_id' => $validated['product_type_id']

            ]

        );

        $product->inventory()->create([
            'quantity' => $validated['quantity'],
            'min_stock_alert' => $validated['min_stock_alert']
        ]);

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load([
            'productType:id,name',
            'inventory:id,product_id,quantity'
        ]);

        $productTypes = ProductType::pluck('name', 'id');
        return view('admin.pages.product.show', [
            'product' => $product,
            'productTypes' => $productTypes
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product->fill(
            [
                'name' => $validated['name'],
                'price' => $validated['price'],
                'product_type_id' => $validated['product_type_id'],
            ]
        );

        if ($product->isDirty()) {
            $product->save();
            return back()->with('status', 'تم التعديل بنجاح');
        }
        return back()->with('info', 'لم يتم إجراء أي تعديل');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function productEntry()
    {
        return view('admin.pages.product.product-entry-method');
    }
}
