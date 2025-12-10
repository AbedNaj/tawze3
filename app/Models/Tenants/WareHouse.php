<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WareHouse extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\WareHouseFactory> */
    use HasFactory;
    protected $guarded = ['id'];


    protected $appends = ['location_name'];

    public function getLocationNameAttribute()
    {
        return $this->location->name ?? __('common.no_location_found');
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
