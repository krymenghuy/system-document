<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'Role',
                'alias' => 'role'
            ],
            [
                'name' => 'User',
                'alias' => 'user'
            ],
            [
                'name' => 'Document',
                'alias' => 'document'
            ],
            // Document Category
            [
                'name' => 'Document Category',
                'alias' => 'document_category'
            ],
            // Document Management
            // [
            //     'name' => 'Document Management',
            //     'alias' => 'document_management'
            // ],
            // Dashboard
            [
                'name' => 'Dashboard',
                'alias' => 'dashboard'
            ],
            // company
            [
                'name' => 'Company',
                'alias' => 'company'
            ],
            
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'name' => $permission['name'],
                'alias' => $permission['alias']
            ]);
        }
    }
}
