<?php

namespace App\Livewire\Admin\Pages\Employee;

use App\Models\Tenants\Employee;
use App\Models\Tenants\Inventory;
use App\Models\Tenants\Sale;
use Livewire\Component;

class Profile extends Component
{
    public $employee;
    public $sales = [], $inventories = [];

    public function fetchInventories()
    {
        if (empty($inventories)) {

            $this->inventories = Inventory::select(
                'id',
                'locationable_id',
                'locationable_type',
                'quantity',
                'product_id',
                'status'
            )
                ->with('product:id,name')
                ->where('locationable_id', $this->employee->id)
                ->where('locationable_type', Employee::class)
                ->get();
        }
    }
    public function fetchSales()
    {

        if (empty($this->sales)) {
            $this->sales = Sale::select('id', 'sourceable_type', 'sourceable_id', 'invoice_number', 'customer_id', 'status', 'invoice_date')
                ->with('customer:id,name')
                ->where('sourceable_type', '=', Employee::class)
                ->where('sourceable_id', $this->employee->id)->get();
        }
    }
    public function render()
    {
        return view('livewire.admin.pages.employee.profile');
    }
}
