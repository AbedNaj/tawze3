<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockMovementMade
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $movementType, $productID, $saleID, $employeeID, $targentEmployee, $createdBy;
    public $quantity, $cost;


    public function __construct($movementType,  $productID, $saleID = null, $employeeID = null, $targentEmployee = null, $quantity, $cost, $createdBy)
    {
        $this->movementType = $movementType;

        $this->productID = $productID;
        $this->saleID = $saleID;
        $this->employeeID = $employeeID;
        $this->quantity = $quantity;
        $this->cost = $cost;
        $this->targentEmployee = $targentEmployee;
        $this->createdBy = $createdBy;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
