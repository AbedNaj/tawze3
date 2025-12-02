<?php

namespace App\Listeners\Admin\Sale;

use App\Enums\DebtStatusEnum;
use App\Events\Admin\Sale\SaleCreated;
use App\Models\Tenants\Debt;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleSaleDebt
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(SaleCreated $event): void
    {

        $debtAmount = $event->sale->price - $event->sale->total_paid;

        if ($debtAmount > 0) {
            Debt::create([
                'sale_id' => $event->sale->id,
                'customer_id' => $event->sale->customer_id,
                'debt_amount' => $debtAmount,
                'remaining_amount' => $debtAmount,
                'status' => DebtStatusEnum::Unpaid,
            ]);
        }
    }
}
