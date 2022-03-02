<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'create-company',
                'guard_name' => 'web'
            ],
            [
                'name' => 'read-company',
                'guard_name' => 'web'
            ],
            [
                'name' => 'update-company',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-company',
                'guard_name' => 'web'
            ],

            [
                'name' => 'create-department',
                'guard_name' => 'web'
            ],
            [
                'name' => 'read-department',
                'guard_name' => 'web'
            ],
            [
                'name' => 'update-department',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-department',
                'guard_name' => 'web'
            ],

            [
                'name' => 'create-employee',
                'guard_name' => 'web'
            ],
            [
                'name' => 'read-employee',
                'guard_name' => 'web'
            ],
            [
                'name' => 'update-employee',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-employee',
                'guard_name' => 'web'
            ],

            [
                'name' => 'create-permission',
                'guard_name' => 'web'
            ],
            [
                'name' => 'read-permission',
                'guard_name' => 'web'
            ],
            [
                'name' => 'update-permission',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-permission',
                'guard_name' => 'web'
            ],

            [
                'name' => 'create-role',
                'guard_name' => 'web'
            ],
            [
                'name' => 'read-role',
                'guard_name' => 'web'
            ],
            [
                'name' => 'update-role',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-role',
                'guard_name' => 'web'
            ]
        ];
        foreach ($data as $key => $value) {
            Permission::create([
                'name' => $value['name'],
                'guard_name' => $value['guard_name']
            ]);
        }
    }
}
