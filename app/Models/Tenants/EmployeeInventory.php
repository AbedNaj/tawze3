<?php

namespace App\Models\Tenants;

use App\Observers\EmployeeInventoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(EmployeeInventoryObserver::class)]
class EmployeeInventory extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\EmployeeInventoryFactory> */
    use HasFactory;
    protected $guarded  = ['id'];


    public function employee()
    {

        return $this->belongsTo(Employee::class);
    }
    public function product()
    {

        return $this->belongsTo(Product::class);
    }
}
