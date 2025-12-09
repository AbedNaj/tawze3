<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\StockMovementFactory> */
    use HasFactory;
    protected $guarded = ['id', 'created_at'];
}
