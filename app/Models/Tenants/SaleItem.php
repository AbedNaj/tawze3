<?php

namespace App\Models\Tenants;

use App\Observers\SaleItemObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([SaleItemObserver::class])]
class SaleItem extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\SaleItemFactory> */
    use HasFactory;




    protected $guarded = ['id'];

    public function sale()
    {

        return $this->belongsTo(Sale::class);
    }

    public function product()
    {

        return $this->belongsTo(Product::class);
    }
}
