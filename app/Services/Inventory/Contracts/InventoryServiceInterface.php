<?php

namespace App\Services\Inventory\Contracts;

use App\DTOs\InventoryRestockResult;

interface InventoryServiceInterface
{
    public function restock(int $inventoryId, int $quantity): InventoryRestockResult;
}
