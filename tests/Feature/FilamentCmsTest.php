<?php

use App\Enums\EnquiryStatus;
use App\Enums\ProjectStatus;
use App\Enums\UserRole;
use App\Filament\Pages\ManageHomepage;
use App\Filament\Pages\ManageSiteSettings;
use App\Filament\Resources\ContactEnquiries\ContactEnquiryResource;
use App\Filament\Resources\ContactEnquiries\Pages\EditContactEnquiry;
use App\Filament\Resources\Projects\Pages\CreateProject;
use App\Filament\Resources\Projects\Pages\ListProjects;
use App\Filament\Resources\Projects\ProjectResource;
use App\Filament\Resources\Services\ServiceResource;
use App\Filament\Resources\TeamMembers\TeamMemberResource;
use App\Models\ContactEnquiry;
use App\Models\HomepageSetting;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

function panelUser(UserRole $role): User
{
    return User::factory()->create(['role' => $role]);
}

function makeEnquiry(): ContactEnquiry
{
    return ContactEnquiry::create(['name' => 'Ada', 'email' => 'ada@example.com', 'message' => 'Hello']);
}

test('editors and admins can open the content resources', function (UserRole $role) {
    actingAs(panelUser($role));

    foreach ([ProjectResource::class, ServiceResource::class, TeamMemberResource::class] as $resource) {
        $this->get($resource::getUrl('index'))->assertOk();
    }
    $this->get(ManageHomepage::getUrl())->assertOk();
})->with([UserRole::Admin, UserRole::Editor]);

test('enquiries and company settings are admin only', function () {
    $enquiry = makeEnquiry();

    actingAs(panelUser(UserRole::Editor));
    $this->get(ContactEnquiryResource::getUrl('index'))->assertForbidden();
    $this->get(ContactEnquiryResource::getUrl('edit', ['record' => $enquiry]))->assertForbidden();
    $this->get(ManageSiteSettings::getUrl())->assertForbidden();

    actingAs(panelUser(UserRole::Admin));
    $this->get(ContactEnquiryResource::getUrl('index'))->assertOk();
    $this->get(ContactEnquiryResource::getUrl('edit', ['record' => $enquiry]))->assertOk();
    $this->get(ManageSiteSettings::getUrl())->assertOk();
});

test('enquiries cannot be created from the panel', function () {
    actingAs(panelUser(UserRole::Admin));

    expect(ContactEnquiryResource::canCreate())->toBeFalse();
});

test('admin updates enquiry status and notes but not submitted details', function () {
    $enquiry = makeEnquiry();
    actingAs(panelUser(UserRole::Admin));

    Livewire::test(EditContactEnquiry::class, ['record' => $enquiry->getRouteKey()])
        ->fillForm(['status' => EnquiryStatus::Responded->value, 'internal_notes' => 'Called back'])
        ->call('save')
        ->assertHasNoFormErrors();

    $enquiry->refresh();
    expect($enquiry->status)->toBe(EnquiryStatus::Responded)
        ->and($enquiry->internal_notes)->toBe('Called back')
        ->and($enquiry->message)->toBe('Hello');
});

test('a new project defaults to an unspecified status and a draft', function () {
    actingAs(panelUser(UserRole::Editor));

    Livewire::test(CreateProject::class)
        ->fillForm(['title' => 'Harbour Offices', 'slug' => 'harbour-offices'])
        ->call('create')
        ->assertHasNoFormErrors();

    $project = Project::where('slug', 'harbour-offices')->firstOrFail();
    expect($project->status)->toBe(ProjectStatus::Unspecified)
        ->and($project->published_at)->toBeNull()
        ->and(Project::published()->count())->toBe(0);
});

test('project slugs must be unique', function () {
    Project::create(['title' => 'A', 'slug' => 'same']);
    actingAs(panelUser(UserRole::Editor));

    Livewire::test(CreateProject::class)
        ->fillForm(['title' => 'B', 'slug' => 'same'])
        ->call('create')
        ->assertHasFormErrors(['slug']);
});

test('image uploads accept images and reject other file types', function () {
    Storage::fake('public');
    actingAs(panelUser(UserRole::Editor));

    Livewire::test(CreateProject::class)
        ->fillForm(['title' => 'Bad', 'slug' => 'bad', 'main_image' => UploadedFile::fake()->create('shell.php', 10, 'application/x-php')])
        ->call('create')
        ->assertHasFormErrors(['main_image']);

    Livewire::test(CreateProject::class)
        ->fillForm(['title' => 'Good', 'slug' => 'good', 'main_image' => UploadedFile::fake()->image('site.jpg')])
        ->call('create')
        ->assertHasNoFormErrors();

    Storage::disk('public')->assertExists(Project::where('slug', 'good')->firstOrFail()->main_image);
});

test('only admins can delete projects', function () {
    $project = Project::create(['title' => 'A', 'slug' => 'a']);
    $editor = panelUser(UserRole::Editor);

    expect($editor->can('delete', $project))->toBeFalse()
        ->and($editor->can('update', $project))->toBeTrue()
        ->and(panelUser(UserRole::Admin)->can('delete', $project))->toBeTrue();
});

test('bulk publish and unpublish change public visibility', function () {
    $ids = collect(['a', 'b'])->map(fn ($s) => Project::create(['title' => $s, 'slug' => $s])->id)->all();
    actingAs(panelUser(UserRole::Editor));

    Livewire::test(ListProjects::class)
        ->selectTableRecords($ids)
        ->callAction(TestAction::make('publish')->table()->bulk());
    expect(Project::published()->count())->toBe(2);

    Livewire::test(ListProjects::class)
        ->selectTableRecords($ids)
        ->callAction(TestAction::make('unpublish')->table()->bulk());
    expect(Project::published()->count())->toBe(0);
});

test('homepage settings save and reject unsafe link destinations', function () {
    actingAs(panelUser(UserRole::Editor));

    Livewire::test(ManageHomepage::class)
        ->fillForm(['hero_headline' => 'Built with care', 'primary_cta_url' => 'javascript:alert(1)'])
        ->call('save')
        ->assertHasFormErrors(['primary_cta_url']);

    Livewire::test(ManageHomepage::class)
        ->fillForm(['hero_headline' => 'Built with care', 'primary_cta_url' => '/projects'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect(HomepageSetting::current()->hero_headline)->toBe('Built with care');
});

test('company settings validate and save for admins', function () {
    actingAs(panelUser(UserRole::Admin));

    Livewire::test(ManageSiteSettings::class)
        ->fillForm(['company_name' => 'Custom Realities Limited', 'primary_email' => 'not-an-email'])
        ->call('save')
        ->assertHasFormErrors(['primary_email']);

    Livewire::test(ManageSiteSettings::class)
        ->fillForm(['company_name' => 'Custom Realities Limited', 'primary_email' => 'info@example.com'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect(SiteSetting::current()->primary_email)->toBe('info@example.com');
});
