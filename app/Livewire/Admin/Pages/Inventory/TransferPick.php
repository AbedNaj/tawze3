<?php

namespace App\Livewire\Admin\Pages\Inventory;

use App\Enums\StockMovementEnums;
use App\Events\StockMovementMade;
use App\Models\Tenants\Employee;
use App\Models\Tenants\Inventory;
use App\Models\Tenants\Product;
use App\Models\Tenants\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class TransferPick extends Component
{
    public $employees = [];
    public $products = [];
    public $productTypes = [];
    public $productType, $product, $employee, $quantity = 0;
    public $productCount = 0;
    protected $rules = [
        'employee' => 'required|exists:employees,id',
        'product' => 'required|exists:products,id',
        'quantity' => [
            'required',
            'numeric',
            'min:1',

        ],
        'productType' => 'required'

    ];


    public function updatedProductType()
    {

        $this->products = Product::select('name', 'id')->where('product_type_id', '=', $this->productType)->get();
    }
    public function updatedProduct()
    {

        $this->productCount = Inventory::where('product_id', '=', $this->product)->value('quantity');
    }
    public function mount()
    {
        $this->productTypes = ProductType::select('name', 'id')->get();

        $this->productType = (int) request()->input('product-type');



        if (Request()->input('product-type')) {


            $this->products = Product::select('name', 'id')->where('product_type_id', '=', $this->productType)->get();
            $this->product = (int) Request()->input('product');
            $this->productCount = Inventory::where('product_id', '=', $this->product)->value('quantity');
        }

        $this->employee =  (int) Request()->input('employee');
    }

    public function transfer()
    {

        $this->validate();

        if ($this->productCount < $this->quantity) {
            throw    ValidationException::withMessages(['quantity' => __('inventory.quantity_error')]);
        }




        DB::transaction(function () {

            $employee = Employee::findOrFail($this->employee);

            $inventory = Inventory::firstOrNew([
                'locationable_type' => Employee::class,
                'locationable_id'   => $this->employee,
                'product_id'        => $this->product,
            ]);

            $inventory->quantity = ($inventory->quantity ?? 0) + $this->quantity;

            $inventory->save();
            //     Inventory::where('product_id', '=', $this->product)->decrement('quantity', $this->quantity);

            event(new StockMovementMade(
                StockMovementEnums::transfer_out->value,
                $this->product,
                null,
                $this->employee,
                null,
                $this->quantity,
                null,
                Auth::guard('admin')->user()->id
            ));

            event(new StockMovementMade(
                StockMovementEnums::transfer_in->value,
                $this->product,
                null,
                $this->employee,
                $this->employee,
                $this->quantity,
                null,
                Auth::guard('admin')->user()->id
            ));
        });

        $this->reset();
    }
    public function render()
    {
        return view('livewire.admin.pages.inventory.transfer-pick');
    }
}
