<?php

namespace App\DTOs;

class InventoryRestockResult
{
    public bool $success;
    public $inventory;
    public string $message;

    public function __construct(bool $success, $inventory = null, string $message = '')
    {
        $this->success = $success;
        $this->inventory = $inventory;
        $this->message = $message;
    }
}
