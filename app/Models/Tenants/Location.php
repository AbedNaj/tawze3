<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\LocationFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function locationable()
    {
        return $this->morphTo();
    }
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function warehouses()
    {
        return $this->hasMany(WareHouse::class);
    }
}
