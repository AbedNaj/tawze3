<?php

namespace App\Observers;

use App\Enums\EmployeeInventoryStatusEnum;
use App\Models\Tenants\EmployeeInventory;

class EmployeeInventoryObserver
{
    /**
     * Handle the EmployeeInventory "created" event.
     */
    public function creating(EmployeeInventory $employeeInventory): void
    {

        if ($employeeInventory['quantity'] == 0) {
            $employeeInventory->status =  EmployeeInventoryStatusEnum::OutStock->value;
        } else {
            $employeeInventory->status =  EmployeeInventoryStatusEnum::InStock->value;
        }
    }

    /**
     * Handle the EmployeeInventory "updated" event.
     */
    public function updating(EmployeeInventory $employeeInventory): void
    {
        if ($employeeInventory['quantity'] == 0) {

            $employeeInventory->status =  EmployeeInventoryStatusEnum::OutStock->value;
        } else {
            $employeeInventory->status =  EmployeeInventoryStatusEnum::InStock->value;
        }
    }

    /**
     * Handle the EmployeeInventory "deleted" event.
     */
    public function deleted(EmployeeInventory $employeeInventory): void
    {
        //
    }

    /**
     * Handle the EmployeeInventory "restored" event.
     */
    public function restored(EmployeeInventory $employeeInventory): void
    {
        //
    }

    /**
     * Handle the EmployeeInventory "force deleted" event.
     */
    public function forceDeleted(EmployeeInventory $employeeInventory): void
    {
        //
    }
}
