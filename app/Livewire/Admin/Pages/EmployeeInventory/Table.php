<?php

namespace App\Livewire\Admin\Pages\EmployeeInventory;

use App\Models\Tenants\Employee;
use App\Models\Tenants\EmployeeInventory;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $employees = [];
    public $selectedEmployee = null;
    public $employeeName = null;
    public $productName;

    public $inventoriess = [];

    public function updatedSelectedEmployee()
    {


        if ($this->selectedEmployee) {
            $this->employeeName = Employee::where('id', $this->selectedEmployee)
                ->value('name');
        } else {
            $this->employeeName = null;
        }
    }

    public function mount()
    {
        $this->employees = Employee::get(['id', 'name']);
    }

    public function updatedProductName()
    {
        $this->resetPage();
    }
    public function render()
    {

        $inventories = collect();

        if ($this->selectedEmployee) {

            $query = EmployeeInventory::query()
                ->select('id', 'employee_id', 'quantity', 'status', 'product_id')
                ->with('product:id,name');
            $query->where('employee_id', $this->selectedEmployee);

            if (!empty($this->productName)) {
                $query->whereHas('product', function ($q) {
                    $q->where('name', 'like', '%' . $this->productName . '%');
                });
            }
            $inventories = $query->paginate(10);
        }





        return view('livewire.admin.pages.employee-inventory.table', [
            'inventories' => $inventories,
        ]);
    }
}
