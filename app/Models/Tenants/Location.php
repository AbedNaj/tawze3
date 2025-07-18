<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\LocationFactory> */
    use HasFactory;

    protected $guarded = ['id'];


    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
