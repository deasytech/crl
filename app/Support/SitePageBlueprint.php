<?php

namespace App\Support;

/**
 * The fixed set of editable site pages and the wording that ships with each.
 *
 * Every default here equals the text that was previously hard-coded in the Blade templates, so the
 * website reads the same until an editor changes it in Filament. A blank field falls back to its default.
 */
final class SitePageBlueprint
{
    /**
     * @return array<string, array{label: string, fields: array<string, string>, extra: array<string, array{0: string, 1: string}>}>
     */
    public static function all(): array
    {
        return [
            'home' => [
                'label' => 'Homepage section headings',
                'fields' => [],
                'extra' => [
                    'intro_eyebrow' => ['Introduction label', 'About Custom Realities'],
                    'intro_link_label' => ['Introduction link text', 'The Company'],
                    'services_eyebrow' => ['Services label', 'What we do'],
                    'services_title' => ['Services heading', 'Integrated services across the building lifecycle.'],
                    'projects_eyebrow' => ['Projects label', 'Selected projects'],
                    'projects_title' => ['Projects heading', 'Work we have designed, built and supervised.'],
                    'projects_link_label' => ['Projects link text', 'All projects'],
                    'approach_eyebrow' => ['Approach label', 'Our approach'],
                    'approach_title' => ['Approach heading', 'From first conversation to final handover.'],
                    'why_eyebrow' => ['Why us label', 'Why Custom Realities'],
                    'why_title' => ['Why us heading', 'A practice built on expertise and long-term relationships.'],
                    'team_eyebrow' => ['People label', 'Our people'],
                    'team_title' => ['People heading', 'Led by experienced architects and project managers.'],
                    'team_link_label' => ['People link text', 'Full team'],
                    'vision_label' => ['Vision label', 'Vision'],
                    'mission_label' => ['Mission label', 'Mission'],
                ],
            ],
            'company' => [
                'label' => 'The Company page',
                'fields' => [
                    'nav_label' => 'The Company',
                    'eyebrow' => 'The Company',
                    'title' => 'A multidisciplinary practice for the built environment.',
                    'seo_title' => 'The Company',
                    'seo_description' => 'About Custom Realities Limited: our vision, mission, client philosophy and technical expertise.',
                ],
                'extra' => [
                    'about_eyebrow' => ['About label', 'About Custom Realities'],
                    'established_label' => ['Established label', 'Established'],
                    'registration_label' => ['Registration label', 'Registration'],
                    'clients_eyebrow' => ['Clients label', 'Our clients'],
                    'clients_heading' => ['Clients heading', 'Clients define our reputation.'],
                    'relationships_eyebrow' => ['Relationships label', 'Relationships'],
                    'relationships_heading' => ['Relationships heading', 'Completion is a step forward, not the end.'],
                    'team_eyebrow' => ['Team label', 'Our team'],
                    'team_heading' => ['Team heading', 'Our people are the practice.'],
                    'expertise_eyebrow' => ['Expertise label', 'Technical expertise'],
                    'expertise_heading' => ['Expertise heading', 'An independent overview and pedigree of experience.'],
                    'capabilities_eyebrow' => ['Capabilities label', 'Multidisciplinary capabilities'],
                    'capabilities_title' => ['Capabilities heading', 'Four disciplines, one practice.'],
                    'leadership_eyebrow' => ['Leadership label', 'Professional team'],
                    'leadership_title' => ['Leadership heading', 'Led by experienced architects and project managers.'],
                    'team_link_label' => ['Team link text', 'Full team'],
                    'vision_label' => ['Vision label', 'Vision'],
                    'mission_label' => ['Mission label', 'Mission'],
                ],
            ],
            'services' => [
                'label' => 'Services pages',
                'fields' => [
                    'nav_label' => 'Services',
                    'eyebrow' => 'Services',
                    'title' => 'Integrated services across the building lifecycle.',
                    'intro' => 'Architecture, construction, building services and project management, delivered by one multidisciplinary practice.',
                    'seo_title' => 'Services',
                    'seo_description' => 'Architecture, construction, building services and project management from Custom Realities Limited.',
                ],
                'extra' => [
                    'capabilities_label' => ['Capabilities label (service page)', 'Capabilities'],
                    'in_practice_eyebrow' => ['Related projects label', 'In practice'],
                    'in_practice_title' => ['Related projects heading (:service is replaced by the service name)', 'Selected :service projects.'],
                    'projects_link_label' => ['Projects link text', 'All projects'],
                    'other_services_label' => ['Other services label', 'Other services'],
                ],
            ],
            'projects' => [
                'label' => 'Projects pages',
                'fields' => [
                    'nav_label' => 'Projects',
                    'eyebrow' => 'Projects',
                    'title' => 'A record of work across sectors.',
                    'intro' => 'Projects are shown with the status and CRL role documented in our company profile.',
                    'seo_title' => 'Projects',
                    'seo_description' => 'Selected architecture, construction and supervision projects by Custom Realities Limited.',
                ],
                'extra' => [
                    'filter_all_label' => ['"All" filter label', 'All'],
                    'empty_message' => ['Message when a category has no projects', 'No projects are published in this category yet.'],
                    'gallery_heading' => ['Project gallery heading', 'Gallery'],
                ],
            ],
            'team' => [
                'label' => 'Team page',
                'fields' => [
                    'nav_label' => 'Our Team',
                    'eyebrow' => 'Our team',
                    'title' => 'The professionals behind the work.',
                    'intro' => 'Core personnel of Custom Realities Limited, supported by affiliate consultants across the built-environment disciplines.',
                    'seo_title' => 'Our Team',
                    'seo_description' => 'The architects, engineers, surveyors and project managers of Custom Realities Limited, and our affiliate consultants.',
                ],
                'extra' => [
                    'core_heading' => ['Core team heading', 'Core team'],
                    'biography_label' => ['Biography toggle text', 'Biography'],
                    'affiliates_eyebrow' => ['Affiliates label', 'Affiliate consultants'],
                    'affiliates_title' => ['Affiliates heading', 'Specialist consultants working alongside the core team.'],
                ],
            ],
            'contact' => [
                'label' => 'Contact page',
                'fields' => [
                    'nav_label' => 'Contact',
                    'eyebrow' => 'Contact',
                    'title' => 'Have a project in mind?',
                    'intro' => "Let's discuss how our expertise can help bring your vision to life.",
                    'seo_title' => 'Contact',
                    'seo_description' => 'Contact Custom Realities Limited in Port Harcourt, Nigeria.',
                ],
                'extra' => [
                    'office_label' => ['Office label', 'Office'],
                    'telephone_label' => ['Telephone label', 'Telephone'],
                    'email_label' => ['Email label', 'Email'],
                    'form_heading' => ['Form heading', 'Send an enquiry'],
                    'form_note' => ['Note under the form', 'Fields marked * are required. We use your details only to respond to your enquiry.'],
                    'submit_label' => ['Submit button text', 'Send enquiry'],
                    'success_title' => ['Confirmation heading', 'Thank you. Your enquiry has been received.'],
                    'success_body' => ['Confirmation message', 'We will review it and get back to you. For anything urgent, please telephone us.'],
                ],
            ],
            'privacy' => [
                'label' => 'Privacy policy',
                'fields' => [
                    'nav_label' => 'Privacy Policy',
                    'eyebrow' => 'Legal',
                    'title' => 'Privacy Policy',
                    'seo_title' => 'Privacy Policy',
                ],
                'extra' => [],
            ],
            'global' => [
                'label' => 'Header and footer',
                'fields' => [],
                'extra' => [
                    'cta_label' => ['Header button text', 'Start a Project'],
                    'footer_explore_label' => ['Footer: explore heading', 'Explore'],
                    'footer_services_label' => ['Footer: services heading', 'Services'],
                    'footer_contact_label' => ['Footer: contact heading', 'Visit & contact'],
                    'footer_social_label' => ['Footer: social links heading', 'Follow us'],
                    'footer_rights' => ['Footer: rights statement', 'All rights reserved.'],
                ],
            ],
        ];
    }
}
