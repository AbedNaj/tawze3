<?php

namespace App\Livewire\Admin\Filters;

use App\Enums\SaleStatusEnum;
use Livewire\Component;

class SaleFilters extends Component
{

    public $customerName = '', $employeeName = '', $saleStatus = '';



    public $saleStatusOptions = [];
    public $relationData, $data;

    public function mount()
    {
        $this->saleStatusOptions = collect(SaleStatusEnum::cases())->map(fn($case) => [
            'label' => $case->label(),
            'id' => $case->value,
        ])->toArray();
    }


    public function fetchData()
    {
        $this->data['status'] = $this->saleStatus;
        $this->relationData = [
            'customer' => ['field' => 'name', 'value' => $this->customerName, 'operator' => '%like%'],
            'employee' => ['field' => 'name', 'value' => $this->employeeName, 'operator' => '%like%'],

        ];
    }

    public function updatedCustomerName()
    {

        $this->fetchData();
        $this->dispatch('set-relation-filters',  data: $this->relationData);
    }
    public function updatedEmployeeName()
    {
        $this->fetchData();

        $this->dispatch('set-relation-filters',  data: $this->relationData);
    }

    public function updatedSaleStatus()
    {

        $this->fetchData();

        $this->dispatch('set-filters',  data: $this->data);
    }
    public function render()
    {
        return view('livewire.admin.filters.sale-filters');
    }
}
