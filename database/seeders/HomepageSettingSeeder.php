<?php

namespace Database\Seeders;

use App\Models\HomepageSetting;
use Illuminate\Database\Seeder;

class HomepageSettingSeeder extends Seeder
{
    public function run(): void
    {
        // Copy suggested in the project brief; editable in the admin panel.
        HomepageSetting::query()->firstOrCreate([], [
            'hero_headline' => 'Building Vision. Creating Realities.',
            'hero_subheading' => 'Custom Realities Limited delivers integrated architectural, construction and project management solutions, transforming ideas into functional, sustainable and enduring built environments.',
            'primary_cta_label' => 'Explore Our Projects',
            'primary_cta_url' => '/projects',
            'secondary_cta_label' => 'Discover Our Services',
            'secondary_cta_url' => '/services',
            'intro_heading' => 'We Create Distinctive Built Environments.',
            'closing_heading' => "Let's Build Something Remarkable Together.",
            'closing_body' => "Have a project in mind? Let's discuss how our expertise can help bring your vision to life.",
            'closing_cta_label' => 'Start a Project',
            'closing_cta_url' => '/contact',
        ]);
    }
}
