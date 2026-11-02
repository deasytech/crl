<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProjectImageSeeder extends Seeder
{
    /**
     * Main images cropped from the company profile slides (pp. 25-34). They are low-resolution
     * (roughly 500-650px at source) and should be replaced with client originals.
     * [slug => [alt, featured, homepage order]]; featured projects are ordered strongest-image first.
     */
    public function run(): void
    {
        $images = [
            'sterling-bank-yenagoa' => ['Completed Sterling Bank branch in Yenagoa, with a glazed and white-rendered facade and a stepped entrance.', true, 3],
            'sterling-bank-hq' => ['Sterling Bank headquarters in Abuja, a four-storey building with red and white vertical banding.', true, 1],
            'cobef-limited' => ['Completed administrative block for Cobef Nig. Ltd, a blue and white three-storey building.', false, null],
            'bekens-office-complex' => ['Completed office building with grey and red facade panels beside a road.', true, 4],
            'rccg-house-of-grace-province-5-headquarters' => ['Church building with arched stained-glass windows and a colonnaded ground floor.', true, 5],
            'nba-secretariat' => ['Computer-generated design render of the NBA Secretariat, Abuja, with a sweeping curved roof.', true, 2],
            'la-sien-hotel' => ['Computer-generated design render of La Sien Hotel, labelled "Proposed Design", with a glazed cylindrical stair tower.', false, null],
        ];

        // File names differ from slugs where the slug is longer.
        $files = ['sterling-bank-hq' => 'sterling-bank-hq-abuja', 'rccg-house-of-grace-province-5-headquarters' => 'rccg-house-of-grace'];

        foreach ($images as $slug => [$alt, $featured, $order]) {
            $project = Project::where('slug', $slug)->first();
            $source = database_path('seeders/assets/projects/'.($files[$slug] ?? $slug).'.jpg');

            // Never overwrite an image an editor has already chosen.
            if (! $project || $project->main_image || ! is_file($source)) {
                continue;
            }

            $path = Storage::disk('public')->putFileAs('projects', new File($source), basename($source));
            $project->update(['main_image' => $path, 'main_image_alt' => $alt, 'is_featured' => $featured] + ($order ? ['sort_order' => $order] : []));
        }
    }
}
