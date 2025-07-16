<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
<<<<<<< HEAD
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'role' => 'superadmin',
                'email' => 'superadmin@gmail.com',
            ],
            [
=======
>>>>>>> 9a9aa51486357edfe72c6b3321aafa5821e401bf
                'name' => 'Admin',
                'username' => 'admin',
                'role' => 'admin',
                'email' => 'admin@gmail.com',
            ],
            [
                'name' => 'Lucturer',
                'username' => 'lucturer',
                'role' => 'lucturer',
                'email' => 'lucturer@gmail.com',
            ],
            [
                'name' => 'Student',
                'username' => 'student',
                'role' => 'student',
                'email' => 'student@gmail.com',
            ],
            [
                'name' => 'Outsider',
                'username' => 'outsider',
                'role' => 'outsider',
                'email' => 'outsider@gmail.com',
            ],
        ];

        foreach ($users as $user) {
<<<<<<< HEAD
            DB::table('users')->updateOrInsert(
                [
                    'username' => $user['username'],
                ],
                [
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'email' => $user['email'],
                    'password' => Hash::make('12345678'),
                ]
            );
=======
            \DB::table('users')->insert([
                'name' => $user['name'],
                'username' => $user['username'],
                'role' => $user['role'],
                'email' => $user['email'],
                'password' => Hash::make('12345678'),
            ]);
>>>>>>> 9a9aa51486357edfe72c6b3321aafa5821e401bf
        }
    }
}
