<?php

namespace App\Livewire\Admin\Pages\Inventory;

use App\Enums\InventoryStatusEnum;
use App\Enums\LocationableTypesEnum;
use App\Models\Tenants\Inventory;
use App\Services\Inventory\Contracts\InventoryServiceInterface;
use Livewire\Component;



class InventoryIndex extends Component
{

    public $locationTypes = [], $selectedLocationType = null, $selectedModelClass;
    public $locationItems = [];
    public  $selectedLocationable;
    public $inventories = [];
    public $inventoryStatusOption = [];

    public $productName = "", $inventoryStatus = null;

    public $transferInventoryID = null;

    public  $quantity = 0;

    protected $rules = [
        'quantity' => 'required|numeric|min:0',
    ];
    public function mount()
    {

        $this->inventoryStatusOption = collect(InventoryStatusEnum::cases())->map(fn($case) => [
            'label' => $case->label(),
            'id' => $case->value,
        ])->toArray();

        $this->locationTypes = collect(LocationableTypesEnum::cases())->map(fn($case) => [
            'label' => $case->label(),
            'id' => $case->value,
        ])->toArray();
    }

    public function updatedSelectedLocationType($enumName)
    {

        $this->reset([
            'selectedLocationable',
            'locationItems',


        ]);

        try {
            $case = LocationableTypesEnum::from($enumName);
        } catch (\ValueError $e) {
            return;
        }

        $this->selectedModelClass = $case->modelClass();


        if (!is_subclass_of($this->selectedModelClass, \Illuminate\Database\Eloquent\Model::class)) {

            abort(400, 'Invalid');
        }


        $this->locationItems = $this->selectedModelClass::query()->select('id', 'name')->orderByDesc('name')->get();
    }

    protected function applyInventoryFilters(): void
    {

        if (! $this->selectedModelClass || ! class_exists($this->selectedModelClass)) {
            $this->inventories = [];
            return;
        }


        $query = Inventory::query()
            ->select('id', 'locationable_id', 'locationable_type', 'min_stock_alert', 'last_restock_date', 'quantity', 'product_id', 'status')
            ->with('product:id,name');


        if ($this->selectedLocationable) {
            $query->where('locationable_id', $this->selectedLocationable);
        }

        $query->where('locationable_type', $this->selectedModelClass);


        if (! empty($this->inventoryStatus)) {
            $query->where('status', $this->inventoryStatus);
        }

        if (! empty($this->productName)) {
            $term = '%' . trim($this->productName) . '%';
            $query->whereHas('product', function ($q) use ($term) {
                $q->where('name', 'like', $term);
            });
        }


        $this->inventories = $query
            ->orderByDesc('id')
            ->limit(200)
            ->get();
    }


    public function updatedSelectedLocationable($value)
    {
        $this->applyInventoryFilters();
    }

    public function updatedInventoryStatus($value)
    {

        $this->applyInventoryFilters();
    }

    public function updatedProductName($value)
    {


        $this->applyInventoryFilters();
    }

    public function inventoryRestock($inventory, InventoryServiceInterface $inventoryService)
    {

        $inventoryService->restock($inventory, $this->quantity);
        $this->applyInventoryFilters();
        $this->reset('quantity');
    }



    public function render()
    {
        return view('livewire.admin.pages.inventory.inventory-index');
    }
}
