<?php

namespace App\Observers;

use App\Enums\InventoryStatusEnum;
use App\Models\Tenants\Inventory;

class InventoryObserver
{
    /**
     * Handle the Inventory "created" event.
     */
    public function creating(Inventory $inventory): void
    {
        if ($inventory['quantity'] >= $inventory['min_stock_alert']) {
            $inventory->status = InventoryStatusEnum::Normal->value;
        } elseif ($inventory['quantity'] < $inventory['min_stock_alert'] && $inventory['quantity'] > 0) {

            $inventory->status = InventoryStatusEnum::LowStock->value;
        } else {
            $inventory->status = InventoryStatusEnum::OutOfStock->value;
        }
    }

    /**
     * Handle the Inventory "updated" event.
     */
    public function updating(Inventory $inventory): void
    {

        if ($inventory['quantity'] >= $inventory['min_stock_alert']) {
            $inventory->status = InventoryStatusEnum::Normal->value;
        } elseif ($inventory['quantity'] < $inventory['min_stock_alert'] && $inventory['quantity'] > 0) {
            $inventory->status = InventoryStatusEnum::LowStock->value;
        } else {

            $inventory->status = InventoryStatusEnum::OutOfStock->value;
        }
    }

    /**
     * Handle the Inventory "deleted" event.
     */
    public function deleted(Inventory $inventory): void
    {
        //
    }

    /**
     * Handle the Inventory "restored" event.
     */
    public function restored(Inventory $inventory): void
    {
        //
    }

    /**
     * Handle the Inventory "force deleted" event.
     */
    public function forceDeleted(Inventory $inventory): void
    {
        //
    }
}
