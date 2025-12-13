<?php

namespace App\Events\Admin\Sale;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SaleCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    // for payment and debt handling
    public $sale, $paymentMoehod, $paidAmount;

    // for inventory handling

    public $saleItems, $employee;
    public function __construct($sale, $paymentMoehod, $paidAmount, $saleItems,)
    {
        $this->sale = $sale;
        $this->paidAmount = $paidAmount;
        $this->paymentMoehod = $paymentMoehod;
        $this->saleItems = $saleItems;
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
