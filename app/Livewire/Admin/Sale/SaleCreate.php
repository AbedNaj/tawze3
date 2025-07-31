<?php

namespace App\Livewire\Admin\Sale;

use App\Enums\SaleStatusEnum;
use App\Models\Tenants\Employee;
use App\Models\Tenants\EmployeeInventory;
use App\Models\Tenants\Inventory;
use App\Models\Tenants\Product;
use App\Models\Tenants\ProductType;
use App\Models\Tenants\Sale;
use App\Models\Tenants\SaleItem;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

use function Pest\Laravel\get;

class SaleCreate extends Component
{


    public $customers = [], $employees = [];

    public $productTypes = [], $products = [];

    public $sale;
    public $isForEmployee = false;
    public $selectedProducts = [];

    public $product, $quantity = 0;

    public $note, $customer, $employee;

    public $saleItems = [], $total = 0;

    public $productInventory, $employeeName;
    public $selectedProductType;
    protected $rules = [
        'product' => 'required|integer|exists:products,id',
        'quantity' => 'nullable|numeric|min:1',
        'note' => 'nullable|string|max:1000',
        'customer' => 'required|exists:customers,id',
        'employee' => 'nullable|exists:employees,id',

    ];


    public function updatedisForEmployee()
    {

        if ($this->isForEmployee == false) {

            $this->sale->update([
                'employee_id' => null,
            ]);
        }
    }

    public function UpdatedEmployee()
    {
        $this->validateOnly('employee');

        $this->sale->update([
            'employee_id' => $this->employee
        ]);

        $this->employeeName = Employee::where('id', '=',  $this->employee)->value('name');
    }

    public function UpdatedCustomer()
    {

        $this->sale->update([
            'customer_id' => $this->customer ?:  null
        ]);
    }
    public function UpdatedNote()
    {
        $this->validateOnly('note');

        $this->sale->update([
            'note' => $this->note
        ]);
    }
    public function UpdatedSelectedProductType()
    {

        $this->products = Product::where('product_type_id', '=', $this->selectedProductType)->pluck('name', 'id');
    }
    public function updatedProduct()
    {
        $this->validateOnly('product');
        $this->productInventory = $this->getInventory($this->product)->value('quantity') ?? 0;
    }

    public function saleConfirm()
    {
        $this->validate([
            'customer' => 'required|exists:customers,id',
        ]);

        if (count($this->saleItems) == 0) {
            $this->dispatch(
                'notify',
                type: 'error',
                message: __('sale.sale.add_products_message')
            );
            return;
        }
        $this->sale->update(
            [
                'status' => SaleStatusEnum::CONFIRMED,
            ]
        );

        $this->dispatch(
            'notify',
            type: 'success',
            message: __('sale.sale.success_product_add')
        );

        return redirect()->route('admin.sales.show', ['sale' => $this->sale->id]);
    }

    public function productItemCreate()
    {


        $this->validate([
            'product' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|numeric|min:1',
        ]);


        if ($this->quantity > $this->productInventory) {
            throw ValidationException::withMessages(['quantity' => __('sale.sale.quantity_error')]);
        }
        $saleItem =   SaleItem::create(
            [
                'sale_id' => $this->sale->id,
                'product_id' => $this->product,
                'stock' => $this->quantity,
            ]
        );

        $this->getInventory($this->product)->decrement('quantity', $this->quantity);

        $this->reset([
            'product',
            'quantity',
            'productInventory'

        ]);

        $this->fetchSaleItems();

        $this->dispatch(
            'notify',
            type: 'success',
            message: __('sale.sale.success_product_add')
        );
    }
    public function cancelItemCreate()
    {
        $this->reset([
            'product',
            'quantity',
            'selectedProductType',
            'productInventory'

        ]);
    }
    public function fetchSaleItems()
    {

        $this->saleItems = SaleItem::select('id', 'product_id', 'stock', 'price', 'sale_id')
            ->with('product:id,name,price')
            ->where('sale_id', '=',  $this->sale->id)->get()->toArray();

        $this->total = 0;

        foreach ($this->saleItems as $item) {
            $this->total  += $item['price'];
        }

        $this->sale->increment('price', $this->total);
    }

    public function increaseQuantity($saleID)
    {
        $saleItem = SaleItem::find($saleID);
        if ($this->inventoryChange(true, $saleItem->product_id) == false) {
            $this->dispatch(
                'notify',
                type: 'error',
                message: __('sale.sale.out_of_stock')
            );
            return;
        }
        $saleItem->stock += 1;
        $saleItem->save();


        $this->fetchSaleItems();
    }

    public function decreaseQuantity($saleID)
    {
        $saleItem = SaleItem::find($saleID);


        if ($saleItem->stock == 1) {
            $this->dispatch(
                'notify',
                type: 'error',
                message: __('sale.sale.decrease_fail')
            );
            return;
        }
        $saleItem->stock -= 1;
        $saleItem->save();
        $this->inventoryChange(false, $saleItem->product_id);
        $this->fetchSaleItems();
    }


    public function inventoryChange($isIncrease = true, $product = null)
    {
        $inventory = $this->getInventory($product)->first();

        if ($isIncrease == true) {

            if ($inventory && $inventory->quantity > 0) {
                $inventory->decrement('quantity', 1);
            } else {
                return false;
            }
        } else {


            if ($inventory) {
                $inventory->increment('quantity', 1);
            }
        }
        return true;
    }
    public function removeProduct($saleID)
    {
        $sale = SaleItem::find($saleID);

        $this->getInventory($sale->product_id)->increment('quantity', $sale->stock);
        $sale->delete();

        $this->dispatch(
            'notify',
            type: 'success',
            message: __('sale.sale.remove_message')
        );
        $this->fetchSaleItems();
    }

    public function getInventory($productId)
    {
        return $this->isForEmployee
            ? EmployeeInventory::where('employee_id', $this->employee)->where('product_id', $productId)
            : Inventory::where('product_id', $productId);
    }
    public function mount()
    {
        $this->sale = Sale::create([
            'price' => 0
        ]);
    }
    public function saleDelete()
    {
        $this->sale->delete();

        $this->dispatch(
            'notify',
            type: 'success',
            message: __('sale.sale.delete_sale')
        );

        return redirect()->route('admin.sales.index');
    }
    public function render()
    {
        return view('livewire.admin.sale.sale-create');
    }
}
