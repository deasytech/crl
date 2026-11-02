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
        Schema::create('site_pages', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('nav_label')->nullable();
            $table->string('eyebrow')->nullable();
            $table->string('title')->nullable();
            $table->text('intro')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->longText('body')->nullable();
            $table->json('extra')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_pages');
    }
};
