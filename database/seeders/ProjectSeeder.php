<?php

namespace Database\Seeders;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Source: company profile pp. 16-19 and portfolio slides 25-34.
     * [category, title, location, involvement, status, year_label, year_start, note]
     * Statuses and years are copied exactly; anything not stated is null/unspecified.
     */
    public function run(): void
    {
        $C = ProjectStatus::Completed;
        $U = ProjectStatus::Unspecified;
        $rows = [
            ['Residential', 'TFC Properties', 'Abuja', null, $C, '2012', 2012, 'Involvement not stated in profile.'],
            ['Residential', 'Trinity Garden Estate', null, 'Design', $C, '2016', 2016, 'p.19 lists Trinity Gardens, Igbo-Etche Road, Port Harcourt as 2005-2010. Confirm whether same project.'],
            ['Residential', 'Jewels Apartments', 'Umuahia', 'Construction', $C, '2017', 2017, 'p.19 separately lists Jewels Apartments, Woji, Port Harcourt (2021-2022). Confirm if distinct.'],
            ['Residential', 'Cole Residence', 'Rivers State', 'Construction', $C, '2018', 2018, null],
            ['Residential', 'Guest House Oloko', 'Umuahia', 'Construction', $C, '2018', 2018, null],
            ['Residential', 'Force Avenue', null, 'Construction', $C, '2020', 2020, 'Location not stated.'],
            ['Religious', 'Chapel of Redemption, University of Calabar (Phase 1)', 'Calabar', 'Design', $C, '2010', 2010, null],
            ['Religious', 'RCCG House of Grace, Province 5 Headquarters', 'Woji, Port Harcourt', 'Design', $C, '2016', 2016, null],
            ['Commercial and Industrial', 'Shawsand Estate', 'Port Harcourt', 'Construction', $C, '2004', 2004, null],
            ['Commercial and Industrial', 'Sterling Bank HQ', 'Abuja', 'Design', $C, '2010', 2010, 'Slide 26 says "Design / Supervision"; table says Design.'],
            ['Commercial and Industrial', 'Deborah Lawson House', null, 'Design', $C, '2011', 2011, 'Location not stated.'],
            ['Commercial and Industrial', 'Rainbow Town Project', 'Port Harcourt', 'Design', ProjectStatus::Stalled, null, null, 'Year not stated. Slides 27-28 describe the work as "Consultancy".'],
            ['Commercial and Industrial', 'FIRS Moscow Road', 'Port Harcourt', 'Construction', $C, '2013', 2013, null],
            ['Commercial and Industrial', 'NBA Secretariat', 'Abuja', 'Design', $C, '2015', 2015, null],
            ['Commercial and Industrial', 'Sterling Bank Yenagoa', 'Yenagoa', 'Construction', $C, '2015', 2015, 'Profile spells "Yenegoa"; normalised to Yenagoa.'],
            ['Commercial and Industrial', 'Cobef Limited', 'Enugu', 'Design', $C, '2015', 2015, 'Slide 29 captions it "Administrative block ... Port Harcourt, Rivers State"; table says Enugu. Confirm.'],
            ['Commercial and Industrial', 'Bekens Office Complex', null, 'Construction', $C, '2021', 2021, 'Slide 30 shows "Office Block for Bekens Motors, Trans-Amadi, Port Harcourt, 2009". Confirm if same project.'],
            ['Infrastructure and Roads', '2-KM Oghege Obagle Nevbuosa Road', 'Edo State', 'Construction', $C, '2014', 2014, null],
            ['Infrastructure and Roads', 'Raphael Avenue by Fido Road, Kpansia', 'Yenagoa', 'Construction', ProjectStatus::Ongoing, '2022', 2022, null],
            ['Educational', 'Mount Olives Group of Schools', 'Anambra State', 'Supervision', $C, '2016', 2016, null],
            ['Educational', 'Primary Schools for Rivers State Government (Greater Port Harcourt)', 'Rivers State', 'Supervision', $U, '2010-2012', 2010, 'Status not stated.'],
            ['Hospitality', 'Royal Suites', 'Port Harcourt', 'Design', $C, '2016', 2016, null],
            ['Hospitality', 'La Sien Hotel', 'Port Harcourt', 'Supervision', ProjectStatus::Stalled, '2015', 2015, null],
            ['Healthcare', 'Shawsand Medical Centre', 'Port Harcourt', null, $C, '2002', 2002, 'Involvement not stated.'],
        ];

        $cats = ProjectCategory::pluck('id', 'name');

        foreach ($rows as $i => [$cat, $title, $location, $involvement, $status, $label, $year, $note]) {
            Project::firstOrCreate(['slug' => Str::slug($title)], [
                'project_category_id' => $cats[$cat],
                'title' => $title,
                'location' => $location,
                'crl_involvement' => $involvement,
                'status' => $status,
                'year_label' => $label,
                'year_start' => $year,
                'sort_order' => $i,
                'admin_notes' => $note ? 'NEEDS CONFIRMATION: '.$note : null,
                'published_at' => now(),
            ]);
        }
    }
}
