<?php

namespace App\Livewire\Admin\Pages\Product;

use App\Models\Tenants\ProductType;
use App\Services\Inventory\Contracts\InventoryServiceInterface;
use Livewire\Component;

class ProductShow extends Component
{

    public $product, $productTypes;
    public $selectedProductType;
    public $inventories = [];
    public function fetchInventories()
    {

        $this->inventories = $this->product->inventories()
            ->with(['locationable:id,name'])
            ->get();
    }
    public  $quantity = 0;

    protected $rules = [
        'quantity' => 'required|numeric|min:0',
    ];
    public function mount()
    {

        $this->productTypes = ProductType::select('name', 'id')->get();
        $this->selectedProductType = $this->product->product_type_id;
    }

    public function inventoryRestock($inventory, InventoryServiceInterface $inventoryService)
    {

        $inventoryService->restock($inventory, $this->quantity);
        $this->fetchInventories();
        $this->reset('quantity');
    }

    public function render()
    {
        return view('livewire.admin.pages.product.product-show');
    }
}
