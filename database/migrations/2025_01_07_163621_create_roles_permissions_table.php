<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id');
            $table->bigInteger('permission_id');
            $table->tinyInteger('views')->default(0);
            $table->tinyInteger('insert')->default(0);
            $table->tinyInteger('update')->default(0);
            $table->tinyInteger('delete')->default(0);
            $table->tinyInteger('show')->default(0);
            $table->tinyInteger('download')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
