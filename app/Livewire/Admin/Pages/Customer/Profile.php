<?php

namespace App\Livewire\Admin\Pages\Customer;

use Livewire\Component;

class Profile extends Component
{
    // initial data
    public $customer, $locations;


    public $sales;


    public function fetchSales()
    {

        $this->sales = $this->customer->sales()->get();
    }
    public function render()
    {
        return view('livewire.admin.pages.customer.profile');
    }
}
