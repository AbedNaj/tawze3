<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\PaymentMethodFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function sales()
    {

        return $this->hasMany(Sale::class);
    }
}
