<?php

namespace Database\Seeders;

use App\Models\SitePage;
use App\Support\SitePageBlueprint;
use Illuminate\Database\Seeder;

class SitePageSeeder extends Seeder
{
    /** Creates any missing page with its shipped wording; never overwrites an editor's changes. */
    public function run(): void
    {
        foreach (array_keys(SitePageBlueprint::all()) as $key) {
            if (! SitePage::query()->where('key', $key)->exists()) {
                SitePage::get($key)->save();
            }
        }
    }
}
