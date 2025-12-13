<?php

namespace App\Models\Tenants;

use App\Enums\SaleStatusEnum;
use App\Observers\SaleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

#[ObservedBy(SaleObserver::class)]
class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\SaleFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($sale) {
            $year = now()->year;
            $nextId = DB::table('sales')->max('id') + 1;
            $number = str_pad($nextId, 6, '0', STR_PAD_LEFT);
            $sale->invoice_number = "INV-{$year}-{$number}";
        });
    }

    public function items()
    {

        return $this->hasMany(SaleItem::class);
    }

    public function paymentMethod()
    {

        return $this->belongsTo(PaymentMethod::class);
    }

    public function customer()
    {

        return $this->belongsTo(Customer::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function debt()
    {
        return $this->hasOne(Debt::class);
    }

    public function sourceable()
    {
        return $this->morphTo();
    }
}
