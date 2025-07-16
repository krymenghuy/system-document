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
<<<<<<< HEAD
                'name' => 'Super Admin',
                'value' => 'superadmin'
            ],
            [
=======
>>>>>>> 9a9aa51486357edfe72c6b3321aafa5821e401bf
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
<<<<<<< HEAD
            // Insert or update the role to avoid duplicate entry errors
            $roleId = DB::table('roles')->updateOrInsert(
                ['value' => $role['value']],
                ['name' => $role['name'], 'value' => $role['value']]
            );

            // Get the role's ID (updateOrInsert returns a boolean, so fetch the ID)
            $role_id = DB::table('roles')->where('value', $role['value'])->first()->id;

            $permissions = DB::table('permissions')->get();
            foreach ($permissions as $permission) {
                // Avoid duplicate role_permissions entries
                DB::table('role_permissions')->updateOrInsert(
                    [
                        'role_id' => $role_id,
                        'permission_id' => $permission->id
                    ],
                    [
                        'views' => 1,
                        'insert' => 1,
                        'update' => 1,
                        'show' => 1,
                        'delete' => 1,
                        'download' => 1,
                    ]
                );
=======
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
>>>>>>> 9a9aa51486357edfe72c6b3321aafa5821e401bf
            }
        }
    }
}
