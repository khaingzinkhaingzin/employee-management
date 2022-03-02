<?php

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ModelHasRoleTableSeeder extends Seeder
{
    public function run()
    {
        $employee = Employee::findOrFail(1);
        $role = Role::findOrFail(1);

        $employee->assignRole($role->name);
    }
}
