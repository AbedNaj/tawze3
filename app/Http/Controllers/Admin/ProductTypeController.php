<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductType\StoreProductTypeRequest;
use App\Http\Requests\Admin\ProductType\UpdateProductTypeRequest;
use App\Models\Tenants\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{

    public function index()
    {
        return view('admin.pages.productType.index');
    }


    public function create()
    {

        return view('admin.pages.productType.create');
    }


    public function store(StoreProductTypeRequest $request)
    {

        $validated = $request->validated();


        ProductType::create([
            'name' => $validated['name']
        ]);

        return redirect()->route('admin.product-types.index')->with([
            'message' => 'Product Type created successfully.',
            'alert-type' => 'success'
        ]);
    }


    public function show(string $id)
    {
        $productType = ProductType::select('id', 'name')->where('id', $id)->firstOrFail();


        return view('admin.pages.productType.show', [
            'productType' => $productType
        ]);
    }


    public function edit(string $id) {}


    public function update(UpdateProductTypeRequest $request, string $id)
    {
        $validated = $request->validated();
        $productType = ProductType::findOrFail($id);

        $productType->fill(['name' => $validated['name']]);

        if ($productType->isDirty()) {
            $productType->save();
            return back()->with('status', 'تم التعديل بنجاح');
        }

        return back()->with('info', 'لم يتم إجراء أي تعديل');
    }



    public function destroy(string $id)
    {

        $productType = ProductType::findOrFail($id);

        if ($productType->delete()) {
            return redirect()->route('admin.product-types.index')->with([
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
