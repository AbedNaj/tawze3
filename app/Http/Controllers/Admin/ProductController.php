<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Product;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Tenants\ProductType;
use Illuminate\Support\Facades\DB;

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

        $productTypes = ProductType::select('name', 'id')->get();


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

        $productTypes = ProductType::select('name', 'id')->get();

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
            return back()->with('status', __('common.edit_successful'));
        }
        return back()->with('info', __('common.edit_unsccessful'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {
            $product->delete();
            $product->inventory()->delete();
        });

        return redirect()->route('admin.products.index')->with('status', __('product.deleted_successfully'));
    }

    public function productEntry()
    {
        return view('admin.pages.product.product-entry-method');
    }
}
