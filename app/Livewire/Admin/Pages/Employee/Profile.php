<?php

namespace App\Livewire\Admin\Pages\Employee;

use App\Models\Tenants\EmployeeInventory;
use App\Models\Tenants\Inventory;
use App\Models\Tenants\Sale;
use Livewire\Component;

class Profile extends Component
{
    public $employee;
    public $sales = [], $inventories = [];

    public function fetchInventories()
    {

        $this->inventories = EmployeeInventory::select('id', 'employee_id', 'quantity', 'product_id', 'status')->with('product:id,name')
            ->where('employee_id', $this->employee->id)->get();
    }
    public function fetchSales()
    {

        $this->sales = Sale::select('id', 'employee_id', 'invoice_number', 'customer_id', 'status', 'invoice_date')
            ->with('customer:id,name')
            ->where('employee_id', $this->employee->id)->get();
    }
    public function render()
    {
        return view('livewire.admin.pages.employee.profile');
    }
}
