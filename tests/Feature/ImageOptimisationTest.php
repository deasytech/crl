<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(fn () => Storage::fake('public'));

test('an uploaded project image gets a webp derivative and the original is untouched', function () {
    $path = UploadedFile::fake()->image('site.jpg', 1200, 800)->store('projects', 'public');
    $project = Project::create(['title' => 'Imaged', 'slug' => 'imaged', 'main_image' => $path, 'published_at' => now()->subDay()]);

    expect($project->optimisedImage('main_image'))->not->toBeNull();
    Storage::disk('public')->assertExists($path);

    $this->get(route('projects.show', $project))
        ->assertOk()
        ->assertSee('<picture>', false)
        ->assertSee('type="image/webp"', false);
});

test('a missing source file does not break saving or rendering', function () {
    $project = Project::create(['title' => 'Ghost', 'slug' => 'ghost', 'main_image' => 'projects/missing.jpg', 'published_at' => now()->subDay()]);

    expect($project->optimisedImage('main_image'))->toBeNull();
    $this->get(route('projects.show', $project))->assertOk();
});

test('replacing the image regenerates the derivative', function () {
    $first = UploadedFile::fake()->image('a.jpg', 800, 600)->store('projects', 'public');
    $second = UploadedFile::fake()->image('b.jpg', 800, 600)->store('projects', 'public');
    $project = Project::create(['title' => 'Swap', 'slug' => 'swap', 'main_image' => $first]);

    $project->update(['main_image' => $second]);

    expect($project->fresh()->getFirstMedia('main_image')->getCustomProperty('source'))->toBe($second);
});
