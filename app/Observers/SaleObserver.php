<?php

namespace App\Observers;

use App\Enums\SalePaymentStatusEnum;
use App\Models\Tenants\Sale;

class SaleObserver
{
    /**
     * Handle the Sale "created" event.
     */
    public function creating(Sale $sale): void {}

    /**
     * Handle the Sale "updated" event.
     */
    public function updating(Sale $sale): void
    {


        if ($sale->isDirty('price') || $sale->isDirty('total_paid')) {

            $price = $sale->price;
            $paid = $sale->total_paid;

            if ($paid == $price) {
                $sale->payment_status = SalePaymentStatusEnum::Paid->value;
            } elseif ($paid == 0) {
                $sale->payment_status = SalePaymentStatusEnum::Unpaid->value;
            } else {
                $sale->payment_status = SalePaymentStatusEnum::PartiallyPaid->value;
            }
        }
    }

    /**
     * Handle the Sale "deleted" event.
     */
    public function deleted(Sale $sale): void
    {
        //
    }

    /**
     * Handle the Sale "restored" event.
     */
    public function restored(Sale $sale): void
    {
        //
    }

    /**
     * Handle the Sale "force deleted" event.
     */
    public function forceDeleted(Sale $sale): void
    {
        //
    }
}
