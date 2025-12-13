<?php

namespace App\Livewire\Admin\Pages\Customer;

use App\Models\Tenants\Sale;
use Livewire\Component;

class Profile extends Component
{
    // initial data
    public $customer, $locations;

    public $selectedLocationID;
    public $sales = [], $debts = [];


    public function fetchSales()
    {

        if (empty($this->sales)) {
            $this->sales = Sale::select('id',  'invoice_number', 'status', 'invoice_date', 'created_by')
                ->with('user:id,name')
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
    public function mount()
    {

        $this->selectedLocationID = $this->customer->location_id;
    }
    public function render()
    {
        return view('livewire.admin.pages.customer.profile');
    }
}
