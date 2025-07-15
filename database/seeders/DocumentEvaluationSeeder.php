<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\DocumentEvaluation;
use App\Models\User;

class DocumentEvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = Document::all();
        $users = User::all();

        if ($users->isEmpty()) {
            // Create a default user if none exists
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
        } else {
            $user = $users->first();
        }

        $evaluations = [
            [
                'document_id' => $documents->where('name', 'Laravel Best Practices Guide')->first()->id,
                'user_id' => $user->id,
                'rating' => 5,
                'text' => 'Excellent guide! Very comprehensive and well-structured. Highly recommended for Laravel developers.'
            ],
            [
                'document_id' => $documents->where('name', 'Business Strategy Framework')->first()->id,
                'user_id' => $user->id,
                'rating' => 4,
                'text' => 'Great framework for business strategy. Very practical and actionable insights.'
            ],
            [
                'document_id' => $documents->where('name', 'Machine Learning Fundamentals')->first()->id,
                'user_id' => $user->id,
                'rating' => 5,
                'text' => 'Outstanding introduction to ML concepts. Clear explanations and good examples.'
            ],
            [
                'document_id' => $documents->where('name', 'Digital Marketing Handbook')->first()->id,
                'user_id' => $user->id,
                'rating' => 4,
                'text' => 'Comprehensive marketing guide with practical strategies and tips.'
            ],
            [
                'document_id' => $documents->where('name', 'Financial Planning Guide')->first()->id,
                'user_id' => $user->id,
                'rating' => 4,
                'text' => 'Very helpful financial planning resource. Well-organized and easy to follow.'
            ],
            [
                'document_id' => $documents->where('name', 'UI/UX Design Principles')->first()->id,
                'user_id' => $user->id,
                'rating' => 5,
                'text' => 'Excellent design principles guide. Modern approach with great examples.'
            ],
            [
                'document_id' => $documents->where('name', 'Legal Compliance Handbook')->first()->id,
                'user_id' => $user->id,
                'rating' => 4,
                'text' => 'Essential legal information presented clearly and comprehensively.'
            ],
            [
                'document_id' => $documents->where('name', 'Software Engineering Patterns')->first()->id,
                'user_id' => $user->id,
                'rating' => 5,
                'text' => 'Great coverage of software patterns. Very useful for developers.'
            ],
            [
                'document_id' => $documents->where('name', 'Health and Wellness Guide')->first()->id,
                'user_id' => $user->id,
                'rating' => 4,
                'text' => 'Comprehensive wellness guide with practical health advice.'
            ],
            [
                'document_id' => $documents->where('name', 'Educational Technology Trends')->first()->id,
                'user_id' => $user->id,
                'rating' => 4,
                'text' => 'Insightful look at current edtech trends. Very informative.'
            ]
        ];

        foreach ($evaluations as $evaluation) {
            DocumentEvaluation::create($evaluation);
        }
    }
}
