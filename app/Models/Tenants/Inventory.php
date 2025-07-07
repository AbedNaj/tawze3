<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\InventoryFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
