<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create Document Categories Table
        Schema::create('document_categories', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Category name
            $table->timestamps(); // created_at and updated_at columns
        });

        // Create Documents Table
        Schema::create('documents', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Document name
            $table->string('author'); // Author name
            $table->year('publication_year'); // Publication year
            $table->string('file_path'); // Path to the document file
            $table->text('description')->nullable(); // Description of the document
            $table->foreignId('category_id')->constrained('document_categories')->onDelete('cascade'); // Foreign key to document_categories
            $table->timestamps(); // created_at and updated_at columns
        });

        // Create Document Evaluations Table
        Schema::create('document_evaluations', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->text('text'); // Evaluation text
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade'); // Foreign key to documents
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_categories');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('document_evaluations');
    }
};
