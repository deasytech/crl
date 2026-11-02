<?php

use App\Enums\ProjectStatus;
use App\Enums\TeamGroup;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/** @param array<string, mixed> $attributes */
function liveProject(string $title, array $attributes = []): Project
{
    return Project::create(['title' => $title, 'slug' => str($title)->slug()->toString(), 'published_at' => now()->subDay()] + $attributes);
}

test('projects can be filtered by category', function () {
    $homes = ProjectCategory::create(['name' => 'Residential', 'slug' => 'residential']);
    $roads = ProjectCategory::create(['name' => 'Infrastructure and Roads', 'slug' => 'infrastructure-and-roads']);
    liveProject('Cole Residence', ['project_category_id' => $homes->id]);
    liveProject('Kpansia Road', ['project_category_id' => $roads->id]);

    $this->get(route('projects.index', ['category' => 'residential']))
        ->assertOk()
        ->assertSee('Cole Residence')
        ->assertDontSee('Kpansia Road');

    $this->get(route('projects.index'))->assertSee('Cole Residence')->assertSee('Kpansia Road');
});

test('categories without published projects are not offered as filters', function () {
    ProjectCategory::create(['name' => 'Institutional', 'slug' => 'institutional']);
    ProjectCategory::create(['name' => 'Religious', 'slug' => 'religious'])
        ->projects()->create(['title' => 'Draft Chapel', 'slug' => 'draft-chapel']);

    $this->get(route('projects.index'))->assertDontSee('Institutional')->assertDontSee('Religious');
});

test('an unknown category falls back to all projects', function () {
    liveProject('Anywhere Tower');

    $this->get(route('projects.index', ['category' => 'nonsense']))->assertOk()->assertSee('Anywhere Tower');
});

test('project detail keeps stalled and ongoing statuses distinct and shows documented facts', function () {
    $category = ProjectCategory::create(['name' => 'Hospitality', 'slug' => 'hospitality']);
    $stalled = liveProject('La Sien Hotel', [
        'project_category_id' => $category->id, 'location' => 'Port Harcourt', 'year_label' => '2015',
        'status' => ProjectStatus::Stalled, 'crl_involvement' => 'Supervision',
    ]);
    $ongoing = liveProject('Raphael Avenue', ['status' => ProjectStatus::Ongoing]);

    $this->get(route('projects.show', $stalled))
        ->assertOk()
        ->assertSeeInOrder(['Category', 'Hospitality', 'Location', 'Port Harcourt', 'Year', '2015', 'Status', 'Stalled', 'CRL role', 'Supervision'])
        ->assertDontSee('Completed');
    $this->get(route('projects.show', $ongoing))->assertSee('Ongoing')->assertDontSee('Completed');
});

test('project detail omits facts that are not documented', function () {
    $project = liveProject('Unknown Facts');

    $this->get(route('projects.show', $project))
        ->assertOk()
        ->assertDontSee('Status')
        ->assertDontSee('Not specified')
        ->assertDontSee('Year')
        ->assertDontSee('Location')
        ->assertDontSee('CRL role');
});

test('project detail renders its gallery with captions', function () {
    $project = liveProject('Gallery House', ['main_image' => 'projects/main.jpg', 'main_image_alt' => 'Front elevation']);
    ProjectImage::create(['project_id' => $project->id, 'path' => 'projects/side.jpg', 'alt' => 'Side view', 'caption' => 'South side']);

    $this->get(route('projects.show', $project))
        ->assertOk()
        ->assertSee('Gallery')
        ->assertSee('Side view')
        ->assertSee('South side')
        ->assertSee('data-lightbox-dialog', false);
});

test('project detail links to neighbouring projects', function () {
    liveProject('First Job', ['sort_order' => 1]);
    $middle = liveProject('Middle Job', ['sort_order' => 2]);
    liveProject('Last Job', ['sort_order' => 3]);

    $this->get(route('projects.show', $middle))->assertSee('First Job')->assertSee('Last Job');
});

test('service pages show capabilities and only link published services', function () {
    $service = Service::create([
        'title' => 'Architecture', 'slug' => 'architecture', 'short_description' => 'Design.',
        'capabilities' => ['Development planning'], 'published_at' => now()->subDay(),
    ]);
    Service::create(['title' => 'Draft Service', 'slug' => 'draft-service']);

    $this->get(route('services.show', $service))->assertOk()->assertSee('Development planning')->assertDontSee('Draft Service');
    $this->get(route('services.index'))->assertSee('Architecture')->assertDontSee('Draft Service');
});

test('team page separates core team from affiliates grouped by category', function () {
    TeamMember::create(['name' => 'Arc. Core Person', 'slug' => 'core', 'designation' => 'MD/CEO', 'biography' => 'A documented biography.', 'group' => TeamGroup::Core, 'published_at' => now()]);
    TeamMember::create(['name' => 'Engr. Affiliate One', 'slug' => 'affiliate', 'group' => TeamGroup::Affiliate, 'professional_category' => 'Structural Engineers', 'published_at' => now()]);
    TeamMember::create(['name' => 'Unpublished Person', 'slug' => 'hidden', 'group' => TeamGroup::Core]);

    $this->get(route('team'))
        ->assertOk()
        ->assertSeeInOrder(['Core team', 'Arc. Core Person', 'MD/CEO', 'A documented biography.', 'Affiliate consultants', 'Structural Engineers', 'Engr. Affiliate One'])
        ->assertDontSee('Unpublished Person');
});

test('company page shows managed copy and registration', function () {
    SiteSetting::create([
        'company_name' => 'Custom Realities Limited', 'registration_number' => '449630', 'founded_year' => 1992,
        'vision' => 'A vision statement.', 'mission' => 'A mission statement.', 'client_philosophy' => 'Clients define our reputation.',
    ]);

    $this->get(route('company'))
        ->assertOk()
        ->assertSee('RC 449630')
        ->assertSee('1992')
        ->assertSee('A vision statement.')
        ->assertSee('A mission statement.')
        ->assertSee('Clients define our reputation.');
});

test('contact page shows verified details alongside the enquiry form', function () {
    SiteSetting::create([
        'company_name' => 'Custom Realities Limited', 'address' => '36 Old Aba Road, Port Harcourt.',
        'office_phone' => '07055981238', 'mobile_phone' => '07030812545', 'primary_email' => 'info@customrealities.com.ng',
    ]);

    $this->get(route('contact'))
        ->assertOk()
        ->assertSee('36 Old Aba Road')
        ->assertSee('tel:07055981238', false)
        ->assertSee('mailto:info@customrealities.com.ng', false)
        ->assertSee('<form', false);
});
