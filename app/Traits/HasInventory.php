<?php

namespace App\Traits;

use App\Models\Tenants\Inventory;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasInventory
{
    public function inventories(): MorphMany
    {
        return $this->morphMany(Inventory::class, 'locationable');
    }
}
