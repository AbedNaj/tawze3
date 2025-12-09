<?php

namespace App\Listeners;

use App\Events\StockMovementMade;
use App\Models\Tenants\StockMovement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleStockMovement
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
    public function handle(StockMovementMade $event): void
    {
        StockMovement::create([
            'type' => $event->movementType,
            'product_id' => $event->productID,
            'sale_id' => $event->saleID,
            'employee_id' => $event->employeeID,
            'quantity' => $event->quantity,
            'cost' => $event->cost,
            'created_by' => $event->createdBy,
            'target_employee_id' => $event->targentEmployee,
        ]);
    }
}
