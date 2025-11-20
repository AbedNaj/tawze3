<?php

namespace App\Livewire\Admin\Filters;

use App\Models\Tenants\Employee;
use Livewire\Component;

class EmployeeInventoryFilters extends Component
{

    public $employees = [];

    public $selectedEmployee = null;

    public function mount()
    {

        $this->employees = Employee::get(['id', 'name']);
    }
    public function render()
    {
        return view('livewire.admin.filters.employee-inventory-filters');
    }
}
