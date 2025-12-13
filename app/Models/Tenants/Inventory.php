<?php

namespace App\Models\Tenants;

use App\Observers\InventoryObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(InventoryObserver::class)]
class Inventory extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\InventoryFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function locationable()
    {
        return $this->morphTo();
    }
}
