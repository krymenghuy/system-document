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
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('email');
            $table->string('location')->nullable()->after('bio');
            $table->string('website')->nullable()->after('location');
            $table->string('timezone')->default('UTC')->after('website');
            $table->string('language')->default('en')->after('timezone');
            $table->boolean('notifications_email')->default(true)->after('language');
            $table->boolean('notifications_push')->default(true)->after('notifications_email');
            $table->boolean('notifications_marketing')->default(false)->after('notifications_push');
            $table->boolean('privacy_profile')->default(true)->after('notifications_marketing');
            $table->boolean('privacy_activity')->default(true)->after('privacy_profile');
            $table->boolean('privacy_search')->default(true)->after('privacy_activity');
            $table->string('theme')->default('light')->after('privacy_search');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio', 'location', 'website', 'photo', 'timezone', 'language',
                'notifications_email', 'notifications_push', 'notifications_marketing',
                'privacy_profile', 'privacy_activity', 'privacy_search', 'theme'
            ]);
        });
    }
};
