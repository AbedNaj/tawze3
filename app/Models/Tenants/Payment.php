<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\PaymentFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function paymentMethod()
    {

        return $this->belongsTo(PaymentMethod::class);
    }
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
