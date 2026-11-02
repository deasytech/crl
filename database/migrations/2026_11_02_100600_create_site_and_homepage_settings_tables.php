<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Both tables hold a single row.
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('registration_number')->nullable();
            $table->string('tagline')->nullable();
            $table->text('footer_text')->nullable();
            $table->text('address')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('primary_email')->nullable();
            $table->string('enquiry_recipient')->nullable();
            $table->string('website_url')->nullable();
            $table->json('social_links')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->unsignedSmallInteger('founded_year')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('og_image')->nullable();
            $table->timestamps();
        });

        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_headline');
            $table->text('hero_subheading')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_image_alt')->nullable();
            $table->string('primary_cta_label')->nullable();
            $table->string('primary_cta_url')->nullable();
            $table->string('secondary_cta_label')->nullable();
            $table->string('secondary_cta_url')->nullable();
            $table->string('intro_heading')->nullable();
            $table->text('intro_body')->nullable();
            $table->string('intro_image')->nullable();
            $table->string('intro_image_alt')->nullable();
            $table->string('closing_heading')->nullable();
            $table->text('closing_body')->nullable();
            $table->string('closing_cta_label')->nullable();
            $table->string('closing_cta_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_settings');
        Schema::dropIfExists('site_settings');
    }
};
