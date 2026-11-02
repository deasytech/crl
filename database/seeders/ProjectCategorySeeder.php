<?php

namespace Database\Seeders;

use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectCategorySeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Residential', 'Commercial and Industrial', 'Religious', 'Educational',
            'Healthcare', 'Hospitality', 'Infrastructure and Roads', 'Institutional',
        ];

        foreach ($names as $i => $name) {
            ProjectCategory::firstOrCreate(['slug' => Str::slug($name)], ['name' => $name, 'sort_order' => $i]);
        }
    }
}
