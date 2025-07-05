<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentCategory;

class DocumentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology',
            'Business',
            'Education',
            'Science',
            'Health',
            'Finance',
            'Marketing',
            'Legal',
            'Engineering',
            'Design'
        ];

        foreach ($categories as $category) {
            DocumentCategory::create([
                'name' => $category
            ]);
        }
    }
}
