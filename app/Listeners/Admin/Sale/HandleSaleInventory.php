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


            $inventory = Inventory::where('product_id', $saleItem['product_id'])
                ->where('locationable_type', '=', $event->sale->sourceable_type)
                ->where('locationable_id', '=', $event->sale->sourceable_id)
                ->lockForUpdate()
                ->firstOrFail();

            $inventory->quantity -= $saleItem['stock'];

            $inventory->save();
        }
    }
}
