<?php

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('public pages render', function (string $route) {
    $this->get(route($route))->assertOk();
})->with(['home', 'company', 'services.index', 'projects.index', 'team', 'contact']);

test('draft projects are hidden from the index and the detail page', function () {
    $draft = Project::create(['title' => 'Draft Tower', 'slug' => 'draft-tower']);
    $live = Project::create(['title' => 'Live Tower', 'slug' => 'live-tower', 'published_at' => now()->subDay()]);

    $this->get(route('projects.index'))->assertSee('Live Tower')->assertDontSee('Draft Tower');
    $this->get(route('projects.show', $draft))->assertNotFound();
    $this->get(route('projects.show', $live))->assertOk();
});

test('future-dated projects are not public', function () {
    $project = Project::create(['title' => 'Later', 'slug' => 'later', 'published_at' => now()->addWeek()]);

    $this->get(route('projects.show', $project))->assertNotFound();
});

test('project status never defaults to completed', function () {
    $project = Project::create(['title' => 'Unknown', 'slug' => 'unknown'])->fresh();

    expect($project->status)->toBe(ProjectStatus::Unspecified);
});

test('draft services are hidden', function () {
    $service = Service::create(['title' => 'Hidden', 'slug' => 'hidden']);

    $this->get(route('services.show', $service))->assertNotFound();
});
