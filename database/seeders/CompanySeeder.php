<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if company already exists
        $existingCompany = DB::table('companies')->where('id', 1)->first();

        if (!$existingCompany) {
            DB::table('companies')->insert([
                'id' => 1,
                'name' => 'Document Management System',
                'email' => 'info@documentsystem.com',
                'phone' => '+1 (555) 123-4567',
                'address' => '123 Business Street, Suite 100, City, State 12345',
                'website' => 'https://documentsystem.com',
                'description' => 'A comprehensive document management system that helps organizations efficiently store, organize, and manage their digital documents. Our platform provides advanced search capabilities, secure file storage, and collaborative features to streamline your document workflow.',
                'photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
