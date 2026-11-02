<?php

use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('pages have a unique title, description, canonical and open graph tags', function () {
    $project = Project::create(['title' => 'Harbour Plaza', 'slug' => 'harbour-plaza', 'summary' => 'A waterfront plaza.', 'published_at' => now()->subDay()]);

    $this->get(route('projects.show', $project))
        ->assertOk()
        ->assertSee('<title>Harbour Plaza |', false)
        ->assertSee('<meta name="description" content="A waterfront plaza.">', false)
        ->assertSee('<link rel="canonical" href="'.route('projects.show', $project).'">', false)
        ->assertSee('<meta property="og:title"', false)
        ->assertSee('<meta property="og:type" content="article">', false);
});

test('organisation structured data uses only stored details', function () {
    SiteSetting::create(['company_name' => 'Custom Realities Limited', 'primary_email' => 'info@example.com']);

    $html = $this->get(route('home'))->getContent();
    preg_match('#<script type="application/ld\+json">(.+?)</script>#s', $html, $m);
    $data = json_decode($m[1], true);

    expect($data['@type'])->toBe('Organization')
        ->and($data['name'])->toBe('Custom Realities Limited')
        ->and($data['email'])->toBe('info@example.com')
        ->and($data)->not->toHaveKeys(['telephone', 'sameAs', 'address']);
});

test('the sitemap lists only published pages', function () {
    Project::create(['title' => 'Live', 'slug' => 'live', 'published_at' => now()->subDay()]);
    Project::create(['title' => 'Draft', 'slug' => 'draft']);
    Service::create(['title' => 'Later', 'slug' => 'later', 'published_at' => now()->addWeek()]);

    $this->get(route('sitemap'))
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
        ->assertSee(route('projects.show', 'live'), false)
        ->assertSee(route('contact'), false)
        ->assertDontSee('/projects/draft', false)
        ->assertDontSee('/services/later', false);
});

test('robots.txt blocks the admin area', function () {
    expect(file_get_contents(public_path('robots.txt')))->toContain('Disallow: /admin');
});
