<?php

namespace App\Livewire\Admin\Pages\WareHouse;

use App\Models\Tenants\Inventory;
use App\Services\Inventory\Contracts\InventoryServiceInterface;
use Livewire\Component;


class WareHouseShow extends Component
{
    public $wareHouse, $inventories = [];

    public $selectedLocationID;

    public  $quantity = 0;

    protected $rules = [
        'quantity' => 'required|numeric|min:0',
    ];

    public function fetchInventories()
    {

        $this->inventories = $this->wareHouse->inventories()->with('product:id,name')->limit(100)->get();
    }
    public function mount()
    {
        $this->selectedLocationID = $this->wareHouse->location_id;
    }


    public function inventoryRestock($inventory, InventoryServiceInterface $inventoryService)
    {

        $inventoryService->restock($inventory, $this->quantity);
        $this->fetchInventories();
        $this->reset('quantity');
    }

    public function render()
    {
        return view('livewire.admin.pages.ware-house.ware-house-show');
    }
}
