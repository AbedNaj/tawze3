<?php

namespace App\Observers;

use App\Models\Tenants\Product;
use App\Models\Tenants\SaleItem;

class SaleItemObserver
{
    /**
     * Handle the SaleItem "created" event.
     */
    public function creating(SaleItem $saleItem): void
    {
        $productPrice = Product::where('id', '=', $saleItem->product_id)->value('price');

        $saleItem->price = $saleItem->stock * $productPrice;
    }

    /**
     * Handle the SaleItem "updated" event.
     */
    public function updating(SaleItem $saleItem): void
    {
        $productPrice = Product::where('id', '=', $saleItem->product_id)->value('price');

        $saleItem->price = $saleItem->stock * $productPrice;
    }

    /**
     * Handle the SaleItem "deleted" event.
     */
    public function deleted(SaleItem $saleItem): void
    {
        //
    }

    /**
     * Handle the SaleItem "restored" event.
     */
    public function restored(SaleItem $saleItem): void
    {
        //
    }

    /**
     * Handle the SaleItem "force deleted" event.
     */
    public function forceDeleted(SaleItem $saleItem): void
    {
        //
    }
}
