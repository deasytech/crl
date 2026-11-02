<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            // Each is a list of {title, body} items managed in Filament.
            $table->json('highlights')->nullable();
            $table->json('approach_steps')->nullable();
            $table->json('why_points')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->dropColumn(['highlights', 'approach_steps', 'why_points']);
        });
    }
};
