<?php

namespace App\Services\Inventory;

use App\Services\Inventory\Contracts\InventoryServiceInterface;
use App\DTOs\InventoryRestockResult;
use App\Models\Tenants\Inventory;
use Illuminate\Support\Facades\DB;
use App\Events\StockMovementMade;
use App\Enums\StockMovementEnums;
use Illuminate\Support\Facades\Auth;

class InventoryService implements InventoryServiceInterface
{
    public function restock(int $inventoryId, int $quantity): InventoryRestockResult
    {
        $result = new InventoryRestockResult(false, null, __('common.start'));

        DB::transaction(function () use ($inventoryId, $quantity, &$result) {

            $inventory = Inventory::lockForUpdate()->findOrFail($inventoryId);

            $inventory->increment('quantity', $quantity);

            $inventory->update([
                'last_restock_date' => now(),
            ]);

            event(new StockMovementMade(
                StockMovementEnums::purchase_in->value,
                $inventory->product_id,
                null,
                null,
                null,
                $quantity,
                null,
                Auth::guard('admin')->id()
            ));

            $result->success = true;
            $result->inventory = $inventory->fresh();
            $result->message = __('inventory.restock_success');
        });

        return $result;
    }
}
