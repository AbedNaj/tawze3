<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\ProductFactory> */
    use HasFactory;
    protected $guarded = ['id', 'created_at'];

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }
}
