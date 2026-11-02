<?php

use App\Enums\UserRole;
use App\Filament\Resources\SitePages\Pages\EditSitePage;
use App\Filament\Resources\SitePages\SitePageResource;
use App\Models\SitePage;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

function pageEditor(): User
{
    return User::factory()->create(['role' => UserRole::Editor]);
}

test('pages show the shipped wording until an editor changes it', function () {
    get('/team')->assertOk()->assertSee('The professionals behind the work.');
});

test('an edited page header and label appear on the public site', function () {
    SitePage::create(['key' => 'team', 'title' => 'Meet the people', 'nav_label' => 'People']);

    get('/team')->assertOk()->assertSee('Meet the people')->assertSee('People');
});

test('a blank edited field falls back to the shipped wording', function () {
    SitePage::create(['key' => 'contact', 'title' => '']);

    get('/contact')->assertSee('Have a project in mind?');
});

test('editors can edit page content through Filament', function () {
    $page = SitePage::get('contact');
    $page->save();

    actingAs(pageEditor());

    Livewire::test(EditSitePage::class, ['record' => $page->getRouteKey()])
        ->fillForm(['title' => 'Talk to us', 'extra.submit_label' => 'Send it'])
        ->call('save')
        ->assertHasNoFormErrors();

    get('/contact')->assertSee('Talk to us')->assertSee('Send it');
});

test('site pages cannot be created or deleted from the panel', function () {
    actingAs(User::factory()->create(['role' => UserRole::Admin]));

    expect(SitePageResource::canCreate())->toBeFalse();
});

test('the privacy page is hidden until it has content', function () {
    get('/privacy')->assertNotFound();
    get('/')->assertDontSee('Privacy Policy');

    SitePage::get('privacy')->fill(['body' => "First paragraph.\n\nSecond paragraph."])->save();

    get('/privacy')->assertOk()->assertSee('First paragraph.');
    get('/')->assertSee('Privacy Policy');
    get('/sitemap.xml')->assertSee('/privacy');
});

test('confirmed social links are shown in the footer', function () {
    SiteSetting::create(['company_name' => 'CRL', 'social_links' => [['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/company/crl']]]);

    get('/')->assertSee('https://linkedin.com/company/crl', false)->assertSee('LinkedIn');
});

test('unknown pages render the branded 404', function () {
    get('/no-such-page')->assertNotFound()->assertSee('Page not found')->assertSee('Back to the homepage');
});
