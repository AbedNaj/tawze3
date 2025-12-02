<?php

namespace App\Listeners\Admin\Sale;

use App\Events\Admin\Sale\SaleCreated;
use App\Models\Tenants\Payment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandlePayment
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

        if ($event->paidAmount > 0) {
            Payment::create([
                'sale_id' => $event->sale->id,
                'payment_method_id' => $event->paymentMoehod,
                'paid_amount' => $event->paidAmount
            ]);
        }
    }
}
