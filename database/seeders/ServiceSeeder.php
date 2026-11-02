<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Descriptions follow the company profile (pp. 8-14) with typographical fixes only.
        $services = [
            [
                'title' => 'Architecture', 'slug' => 'architecture',
                'short_description' => 'Developments that meet the needs of the target market, suit the proposed site and address environmental, zoning and regulatory requirements.',
                'description' => "CUSTOM REALITIES LIMITED provides the expertise required to create a development that meets the needs of the target market, suits the proposed site and addresses local environmental zoning and regulatory issues. Our team of Architects and Planners has extensive experience with conventional and traditional methods of designing in relation to the built environment. We blend the client's program and market demand with the environmental and statutory requirements. We design and manage the building process economically. We have extensive experience with the design of active facilities.",
                'capabilities' => ['Architectural design', 'Development planning', 'Site suitability', 'Environmental and statutory considerations', 'Design coordination'],
                'published' => true,
            ],
            [
                'title' => 'Construction', 'slug' => 'construction',
                'short_description' => 'Efficient mobilisation and delivery of building projects to the highest standards.',
                'description' => 'CUSTOM REALITIES LIMITED has been involved in building projects and has gained extensive experience over the years. Considering the relevant professional resources, facilities and wealth of experience available, we are in the best position to undertake construction projects efficiently, mobilize in the shortest time possible and perform to the highest standards.',
                'capabilities' => ['Building construction', 'Resource mobilisation', 'Delivery to high standards'],
                'published' => true,
            ],
            [
                'title' => 'Building Services', 'slug' => 'building-services',
                'short_description' => 'Design and execution of building services, from engineering design support to maintenance across the building life cycle.',
                'description' => 'CUSTOM REALITIES LIMITED has been involved in the design and execution of building services for numerous projects and has the skills and expertise to take on any project large or small. We have everything it takes to bring a project to life, from engineering design support to maintenance services in the course of the building life cycle. We can guarantee standard quality across the entire project at the best possible costs. We also promote and represent building product manufacturers.',
                'capabilities' => ['Design and execution of building services', 'Engineering design support', 'Maintenance across the building life cycle', 'Representation of building product manufacturers'],
                'published' => true,
            ],
            [
                'title' => 'Project Management', 'slug' => 'project-management',
                'short_description' => 'Planning, organising and managing projects to achieve project goals within budget and time frame.',
                'description' => 'CUSTOM REALITIES LIMITED has been involved in planning, organizing and managing projects using specific processes, skills and knowledge to achieve project-specific goals within a budget and time frame. Our seasoned professionals, with several years of experience in project management and execution, deliver according to specifications using cost control mechanisms and manpower for overall project success.',
                'capabilities' => ['Project planning', 'Cost control', 'Manpower and resource management', 'Delivery within budget and time frame'],
                'published' => true,
            ],
            [
                // The profile has a "Supervision" image page (p. 11) with no text; the client's
                // 28 Oct 2026 letter names "Supervision & QA/QC". Kept as a draft until copy is supplied.
                'title' => 'Supervision and QA/QC', 'slug' => 'supervision-and-qa-qc',
                'short_description' => null, 'description' => null, 'capabilities' => null,
                'published' => false,
            ],
        ];

        foreach ($services as $i => $s) {
            Service::firstOrCreate(['slug' => $s['slug']], [
                'title' => $s['title'],
                'short_description' => $s['short_description'],
                'description' => $s['description'],
                'capabilities' => $s['capabilities'],
                'sort_order' => $i,
                'is_featured' => $s['published'],
                'published_at' => $s['published'] ? now() : null,
            ]);
        }
    }
}
