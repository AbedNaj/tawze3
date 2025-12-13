<?php

namespace App\Models\Tenants;

use App\Models\Tenants\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Traits\HasInventory;
use App\Traits\HasSale;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\EmployeeFactory> */
    use HasFactory, HasInventory, HasSale;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
