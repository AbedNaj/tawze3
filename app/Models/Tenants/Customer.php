<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\CustomerFactory> */
    use HasFactory;

    protected $guarded = ['id'];


    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function debts()
    {
        return $this->hasMany(Debt::class);
    }
}
