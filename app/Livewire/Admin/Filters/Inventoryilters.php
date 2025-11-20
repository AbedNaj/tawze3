<?php

namespace App\Livewire\Admin\Filters;

use App\Enums\InventoryStatusEnum;
use Livewire\Component;

class Inventoryilters extends Component
{
    public $inventoryStatusOption = [];

    public $productName = "", $inventoryStatus = null;

    public $data, $relationData;


    public function mount()
    {
        $this->inventoryStatusOption = collect(InventoryStatusEnum::cases())->map(fn($case) => [
            'label' => $case->label(),
            'id' => $case->value,
        ])->toArray();
    }


    public function fetchData()
    {
        $this->data['status'] = $this->inventoryStatus;
        $this->relationData = [
            'product' => ['field' => 'name', 'value' => $this->productName, 'operator' => '%like%'],

        ];
    }

    public function updatedProductName()
    {

        $this->fetchData();
        $this->dispatch('set-relation-filters',  data: $this->relationData);
    }
    public function updatedInventoryStatus()
    {

        $this->fetchData();

        $this->dispatch('set-filters',  data: $this->data);
    }
    public function render()
    {
        return view('livewire.admin.filters.inventoryilters');
    }
}
