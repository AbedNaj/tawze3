<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\ProductTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
