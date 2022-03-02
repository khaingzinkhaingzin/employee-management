<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Department;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasRoles;

    protected $fillable = [ 
        'first_name',
        'last_name',
        'email',
        'phone',
        'staff_id',
        'address',
        'password',
        'company_id',
        'department_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
