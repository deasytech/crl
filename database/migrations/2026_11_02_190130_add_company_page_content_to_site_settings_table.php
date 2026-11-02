<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->text('about_body')->nullable()->after('founded_year');
            $table->text('client_philosophy')->nullable()->after('about_body');
            $table->text('client_relationships')->nullable()->after('client_philosophy');
            $table->text('team_philosophy')->nullable()->after('client_relationships');
            $table->text('technical_expertise')->nullable()->after('team_philosophy');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['about_body', 'client_philosophy', 'client_relationships', 'team_philosophy', 'technical_expertise']);
        });
    }
};
