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
        $site = SiteSetting::query()->firstOrCreate([], [
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

        // Company page copy (profile pp. 4-7). Filled only while empty so admin edits are never overwritten.
        $site->about_body ??= 'Custom Realities Limited is a multidisciplinary company providing architecture, construction, building services and project management. The firm was founded in 1992 by its MD/CEO, Arc. Oriaku Hanson Oyet-Ile.';
        $site->client_philosophy ??= "Our clients are of the utmost importance to us. They define our reputation and our position in the market. It is not enough merely to attract clients; our aim is to keep them. This is why we always endeavour to exceed expectations, creating the foundation for beneficial long-term working relationships.\n\nWe are dedicated first and foremost to assisting our clients derive maximum value from their built assets. Our approach is totally customer-focused. We are committed to generating value and ensuring that our clients' built assets work for them in the most cost-effective way. The quality of our service relies upon our understanding and knowledge of the environment in which they operate, and the drivers that shape and influence their businesses.";
        $site->client_relationships ??= 'Our success relies on a strong relationship between our client, their in-house teams and ours. For us, the completion of a project is not the end of the process; we view this as another successful step forward in our relationship with the client.';
        $site->team_philosophy ??= "We would be nothing without our people. We employ and train our people and retain them through encouragement and reward. Our extensive training programmes mean our people are always up to date with industry developments and able to act in the clients' best interests. Our clients can be sure the best professionals are working on their projects.";
        $site->technical_expertise ??= 'Our independent overview and pedigree of experience means we can define and manage all the contractual, financial and technical aspects of even the most complex projects, ensuring that our clients\' objectives are realized.';
        $site->save();
    }
}
