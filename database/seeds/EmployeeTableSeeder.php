<?php

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    public function run()
    {
        $employee              = new Employee();
        $employee->first_name  = "DB";
        $employee->last_name   = "Admin";
        $employee->email       = "admin@gmail.com";
        $employee->password    = Hash::make("123123123");
        $employee->save();
    }
}
