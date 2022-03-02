<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin              = new Role();
        $admin->name        = "Admin";
        $admin->guard_name  = "web";
        $admin->save();

        $permissions = Permission::all()->pluck('id')->toArray();
        $admin->syncPermissions($permissions);
        
        $admin              = new Role();
        $admin->name        = "Employee";
        $admin->guard_name  = "web";
        $admin->save();
    }
}
