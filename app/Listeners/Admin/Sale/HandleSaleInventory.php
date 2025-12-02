<?php

namespace App\Listeners\Admin\Sale;

use App\Events\Admin\Sale\SaleCreated;
use App\Models\Tenants\EmployeeInventory;
use App\Models\Tenants\Inventory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleSaleInventory
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SaleCreated $event): void
    {

        foreach ($event->saleItems as $saleItem) {

            if ($event->employee) {
                $inventory = EmployeeInventory::where('employee_id', $event->employee)
                    ->where('product_id', $saleItem['product_id'])
                    ->lockForUpdate()
                    ->firstOrFail();
                $inventory->quantity -= $saleItem['stock'];

                $inventory->save();
            } else {
                $inventory = Inventory::where('product_id', $saleItem['product_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                $inventory->quantity -= $saleItem['stock'];

                $inventory->save();
            }
        }
    }
}
