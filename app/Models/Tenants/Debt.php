<?php

namespace App\Models\Tenants;

use App\Observers\DebtObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(DebtObserver::class)]
class Debt extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\DebtFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}
