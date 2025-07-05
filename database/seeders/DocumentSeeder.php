<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\DocumentCategory;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DocumentCategory::all();

        $documents = [
            [
                'name' => 'Laravel Best Practices Guide',
                'author' => 'John Doe',
                'publication_year' => 2024,
                'description' => 'A comprehensive guide to Laravel development best practices, covering architecture, security, and performance optimization.',
                'category_id' => $categories->where('name', 'Technology')->first()->id,
                'file_path' => 'documents/laravel-guide.pdf'
            ],
            [
                'name' => 'Business Strategy Framework',
                'author' => 'Jane Smith',
                'publication_year' => 2024,
                'description' => 'Strategic framework for modern business development and market analysis.',
                'category_id' => $categories->where('name', 'Business')->first()->id,
                'file_path' => 'documents/business-strategy.pdf'
            ],
            [
                'name' => 'Machine Learning Fundamentals',
                'author' => 'Dr. Robert Johnson',
                'publication_year' => 2024,
                'description' => 'Introduction to machine learning concepts, algorithms, and practical applications.',
                'category_id' => $categories->where('name', 'Science')->first()->id,
                'file_path' => 'documents/ml-fundamentals.pdf'
            ],
            [
                'name' => 'Digital Marketing Handbook',
                'author' => 'Sarah Wilson',
                'publication_year' => 2024,
                'description' => 'Complete guide to digital marketing strategies, SEO, and social media marketing.',
                'category_id' => $categories->where('name', 'Marketing')->first()->id,
                'file_path' => 'documents/digital-marketing.pdf'
            ],
            [
                'name' => 'Financial Planning Guide',
                'author' => 'Michael Brown',
                'publication_year' => 2024,
                'description' => 'Comprehensive financial planning guide for individuals and businesses.',
                'category_id' => $categories->where('name', 'Finance')->first()->id,
                'file_path' => 'documents/financial-planning.pdf'
            ],
            [
                'name' => 'UI/UX Design Principles',
                'author' => 'Emily Davis',
                'publication_year' => 2024,
                'description' => 'Modern UI/UX design principles and best practices for web and mobile applications.',
                'category_id' => $categories->where('name', 'Design')->first()->id,
                'file_path' => 'documents/ui-ux-design.pdf'
            ],
            [
                'name' => 'Legal Compliance Handbook',
                'author' => 'Attorney Lisa Chen',
                'publication_year' => 2024,
                'description' => 'Essential legal compliance guidelines for businesses and organizations.',
                'category_id' => $categories->where('name', 'Legal')->first()->id,
                'file_path' => 'documents/legal-compliance.pdf'
            ],
            [
                'name' => 'Software Engineering Patterns',
                'author' => 'David Miller',
                'publication_year' => 2024,
                'description' => 'Common software engineering patterns and architectural principles.',
                'category_id' => $categories->where('name', 'Engineering')->first()->id,
                'file_path' => 'documents/engineering-patterns.pdf'
            ],
            [
                'name' => 'Health and Wellness Guide',
                'author' => 'Dr. Amanda Taylor',
                'publication_year' => 2024,
                'description' => 'Comprehensive health and wellness guide for modern lifestyle.',
                'category_id' => $categories->where('name', 'Health')->first()->id,
                'file_path' => 'documents/health-wellness.pdf'
            ],
            [
                'name' => 'Educational Technology Trends',
                'author' => 'Professor James Wilson',
                'publication_year' => 2024,
                'description' => 'Current trends and innovations in educational technology.',
                'category_id' => $categories->where('name', 'Education')->first()->id,
                'file_path' => 'documents/edtech-trends.pdf'
            ]
        ];

        foreach ($documents as $document) {
            Document::create($document);
        }
    }
}
