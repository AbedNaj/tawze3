<?php

namespace App\Observers;

use App\Enums\DebtStatusEnum;
use App\Models\Tenants\Debt;

class DebtObserver
{
    /**
     * Handle the Debt "created" event.
     */
    public function creating(Debt $debt): void
    {
        //
    }

    /**
     * Handle the Debt "updated" event.
     */
    public function updating(Debt $debt): void
    {
        if ($debt->isDirty('paid_amount') || $debt->isDirty('remaining_amount')) {

            $price = $debt->price;
            $paid = $debt->total_paid;

            if ($paid == $price) {
                $debt->status = DebtStatusEnum::Paid->value;
            } elseif ($paid == 0) {
                $debt->status = DebtStatusEnum::Unpaid->value;
            } else {
                $debt->status = DebtStatusEnum::PartiallyPaid->value;
            }
        }
    }

    /**
     * Handle the Debt "deleted" event.
     */
    public function deleted(Debt $debt): void
    {
        //
    }

    /**
     * Handle the Debt "restored" event.
     */
    public function restored(Debt $debt): void
    {
        //
    }

    /**
     * Handle the Debt "force deleted" event.
     */
    public function forceDeleted(Debt $debt): void
    {
        //
    }
}
