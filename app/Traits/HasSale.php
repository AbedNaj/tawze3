<?php

namespace App\Traits;

use App\Models\Tenants\Sale;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasSale
{

    public function sales(): MorphMany
    {
        return $this->morphMany(Sale::class, 'sourceable');
    }
}
