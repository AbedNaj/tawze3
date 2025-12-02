<?php

namespace App\Livewire\Admin\Pages\Customer;

use App\Models\Tenants\Sale;
use Livewire\Component;

class Profile extends Component
{
    // initial data
    public $customer, $locations;


    public $sales = [], $debts = [];


    public function fetchSales()
    {

        if (empty($this->sales)) {
            $this->sales = Sale::select('id', 'employee_id', 'invoice_number', 'status', 'invoice_date')->with('employee:id,name')
                ->orderby('invoice_number', 'desc')
                ->where('customer_id', '=', $this->customer->id)->get();
        }
    }

    public function fetchDebts()
    {
        if (empty($this->debts)) {
            $this->debts = $this->customer->debts()->with('sale:id,invoice_number')->get();
        }
    }
    public function render()
    {
        return view('livewire.admin.pages.customer.profile');
    }
}
