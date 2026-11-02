<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed verified CRL content. Safe to re-run: every seeder only creates missing records and never overwrites admin edits.
     * No user accounts are created; provision admins with `php artisan crl:make-admin`.
     */
    public function run(): void
    {
        $this->call([
            SiteSettingSeeder::class,
            HomepageSettingSeeder::class,
            ProjectCategorySeeder::class,
            ServiceSeeder::class,
            ProjectSeeder::class,
            TeamMemberSeeder::class,
        ]);
    }
}
