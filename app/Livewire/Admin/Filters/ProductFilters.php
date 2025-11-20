<?php

namespace App\Livewire\Admin\Filters;

use App\Models\Tenants\ProductType;
use Livewire\Component;

class ProductFilters extends Component
{


    public $productTypes = [];

    public $productType;

    public $data;
    public $name;

    public function fetchData()
    {
        $this->data['product_type_id'] = $this->productType;
    }
    public function updatedProductType()
    {

        $this->fetchData();

        $this->dispatch('set-filters',  data: $this->data);
    }


    public function mount()
    {
        $this->productTypes = ProductType::select('id', 'name')->get();
    }
    public function render()
    {
        return view('livewire.admin.filters.product-filters');
    }
}
