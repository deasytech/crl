<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        // Source: CRL company profile (pp. 2-3). Phone, address spelling and
        // secondary emails are awaiting client confirmation (see docs).
        SiteSetting::query()->firstOrCreate([], [
            'company_name' => 'Custom Realities Limited',
            'registration_number' => '449630',
            'tagline' => 'Architecture • Construction • Services',
            'address' => '36 Old Aba Road, Rumukwurushi, Port Harcourt, Rivers State, Nigeria.',
            'office_phone' => '07055981238',
            'mobile_phone' => '07030812545',
            'primary_email' => 'info@customrealities.com.ng',
            'website_url' => 'https://www.customrealities.com.ng',
            'founded_year' => 1992,
            'vision' => 'To consistently deliver excellent sustainable customized solutions that are environmentally friendly through creativity and innovation.',
            'mission' => 'We create distinctive buildings and supporting services for the built environment using best business practices that promote team cohesion and guarantees our strong leadership position.',
            'footer_text' => 'Custom Realities Limited delivers integrated architectural, construction and project management solutions.',
        ]);
    }
}
