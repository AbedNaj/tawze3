<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StockMovementEnums;
use App\Events\StockMovementMade;
use App\Http\Controllers\Controller;
use App\Models\Tenants\Inventory;
use App\Http\Requests\Admin\Inventory\StoreInventoryRequest;
use App\Http\Requests\Admin\Inventory\UpdateInventoryRequest;
use App\Models\Tenants\Employee;
use App\Models\Tenants\EmployeeInventory;
use App\Models\Tenants\Product;
use App\Models\Tenants\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.inventory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {

        $inventory->load('product:name,id,product_type_id');
        return view('admin.pages.inventory.show', ['inventory' => $inventory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        $validated = $request->validated();
        $inventory->fill(
            [
                'min_stock_alert' => $validated['min_stock_alert']
            ]
        );

        if ($inventory->isDirty()) {
            $inventory->save();

            return back()->with('status', 'تم التعديل بنجاح');
        }
        return back()->with('info', 'لم يتم إجراء أي تعديل');
    }

    public function restock(Request $request, Inventory $inventory)
    {

        $validated = $request->validate([
            'quantity' => 'numeric|required|min:0',
        ]);
        DB::transaction(function () use ($validated, $inventory) {
            $inventory->increment('quantity', $validated['quantity']);

            $inventory->update([
                'last_restock_date' => now()
            ]);
            event(new StockMovementMade(
                StockMovementEnums::purchase_in->value,
                $inventory->product_id,
                null,
                null,
                null,
                $validated['quantity'],
                null,
                Auth::guard('admin')->user()->id
            ));
        });

        return redirect()->route('admin.inventory.show', $inventory)->with('status', 'تمت إعادة التوريد بنجاح');
    }
    public function transfer()
    {

        return view('admin.pages.inventory.transfer');
    }



    public function transterUpdate(Request $request)
    {
        // this function is no longer in use because LiveWire component is reponsible of the transfer


        $validated = $request->validate(
            [
                'employee' => 'required|exists:employees,id',
                'product' => 'required|exists:products,id',
                'quantity' => 'required|numeric|min:0',
            ]
        );


        $oldQuantity = EmployeeInventory::where('employee_id', '=', $validated['employee'])
            ->where('product_id', '=', $validated['product'])
            ->value('quantity') ?? 0;

        $finalQuantity = $oldQuantity + $validated['quantity'];
        EmployeeInventory::updateOrCreate([
            'employee_id' =>  $validated['employee'],
            'product_id' => $validated['product']
        ], ['quantity' => $finalQuantity]);

        return back();
    }
}
