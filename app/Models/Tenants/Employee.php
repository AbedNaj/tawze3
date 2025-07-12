<?php

namespace App\Models\Tenants;

use App\Models\Tenants\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\EmployeeFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(EmployeeUser::class, 'employee_user_id');
    }
}
