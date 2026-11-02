<?php

namespace Database\Seeders;

use App\Models\HomepageSetting;
use Illuminate\Database\Seeder;

class HomepageSettingSeeder extends Seeder
{
    public function run(): void
    {
        // Copy suggested in the project brief and drawn from the company profile; editable in the admin panel.
        $home = HomepageSetting::query()->firstOrCreate([], [
            'hero_headline' => 'Building Vision. Creating Realities.',
            'hero_subheading' => 'Custom Realities Limited delivers integrated architectural, construction and project management solutions, transforming ideas into functional, sustainable and enduring built environments.',
            'primary_cta_label' => 'Explore Our Projects',
            'primary_cta_url' => '/projects',
            'secondary_cta_label' => 'Discover Our Services',
            'secondary_cta_url' => '/services',
            'closing_heading' => "Let's Build Something Remarkable Together.",
            'closing_body' => "Have a project in mind? Let's discuss how our expertise can help bring your vision to life.",
            'closing_cta_label' => 'Start a Project',
            'closing_cta_url' => '/contact',
        ]);

        // Fill content blocks only while empty, so admin edits are never overwritten.
        $home->intro_heading ??= 'We Create Distinctive Built Environments.';
        $home->intro_body ??= "Custom Realities Limited is a multidisciplinary company providing architecture, construction, building services and project management. We combine creativity, technical expertise and professional project execution to create distinctive buildings and supporting services for the built environment.\n\nOur approach is customer-focused: we are dedicated to helping clients derive maximum value from their built assets.";

        $home->highlights ??= [
            ['title' => 'Founded in 1992', 'body' => 'Established by our MD/CEO, Arc. Oriaku Hanson Oyet-Ile.'],
            ['title' => 'Multidisciplinary team', 'body' => 'Architects, engineers, surveyors and project managers working together.'],
            ['title' => 'Broad project experience', 'body' => 'Residential, commercial, religious, educational, healthcare, hospitality and infrastructure work.'],
            ['title' => 'One integrated practice', 'body' => 'Architecture, construction, building services and project management.'],
        ];

        // Presentation labels for the website, not a claim that every engagement follows this exact process.
        $home->approach_steps ??= [
            ['title' => 'Consultation and Planning', 'body' => "Understanding the client's programme, the site, and the environmental and statutory requirements."],
            ['title' => 'Design and Development', 'body' => "Blending the client's programme and market demand with regulatory requirements."],
            ['title' => 'Project Execution', 'body' => 'Mobilising professional resources to build efficiently and to a high standard.'],
            ['title' => 'Supervision and Delivery', 'body' => 'Cost control, supervision and oversight of time and budget through to completion.'],
        ];

        $home->why_points ??= [
            ['title' => 'Multidisciplinary technical expertise', 'body' => 'Design, engineering and delivery capability under one roof.'],
            ['title' => 'Experienced architects and engineers', 'body' => 'A seasoned team supported by affiliate consultants.'],
            ['title' => 'Project management capability', 'body' => 'Planning, coordination and cost control through to handover.'],
            ['title' => 'Client-focused approach', 'body' => 'We treat the completion of a project as another step in a lasting relationship.'],
            ['title' => 'Technical and financial oversight', 'body' => 'We can define and manage the contractual, financial and technical aspects of complex projects.'],
            ['title' => 'Commitment to quality and sustainability', 'body' => 'Sustainable, customised solutions delivered through creativity and innovation.'],
        ];

        $home->save();
    }
}
