<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'value' => 'superadmin'
            ],
            [
                'name' => 'Admin',
                'value' => 'admin'
            ],
            [
                'name' => 'Lucturer',
                'value' => 'lucturer'
            ],
            [
                'name' => 'Student',
                'value' => 'student'
            ],
            [
                'name' => 'Outsider',
                'value' => 'outsider'
            ],

  
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);

            $role_id = DB::table('roles')->where('name', $role['name'])->first()->id;

            $permissions = DB::table('permissions')->get();
            foreach ($permissions as $permission) {
                DB::table('role_permissions')->insert([
                    'role_id' => $role_id,
                    'permission_id' => $permission->id,
                    'views' => 1,
                    'insert' => 1,
                    'update' => 1,
                    'show' => 1,
                    'delete' => 1,
                    'download' => 1,	
                ]);
            }
        }
    }
}
