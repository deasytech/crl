<?php

use App\Enums\EnquiryStatus;
use App\Mail\NewContactEnquiry;
use App\Models\ContactEnquiry;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

function validEnquiry(array $overrides = []): array
{
    return [
        'name' => 'Ada Obi',
        'email' => 'ada@example.com',
        'phone' => '+234 803 000 0000',
        'organisation' => 'Obi Holdings',
        'service' => 'Other / not sure',
        'project_location' => 'Port Harcourt',
        'message' => 'We are planning a mixed-use development.',
        ...$overrides,
    ];
}

test('the contact page shows the enquiry form', function () {
    Service::create(['title' => 'Architecture', 'slug' => 'architecture', 'published_at' => now()->subDay()]);
    Service::create(['title' => 'Hidden Draft', 'slug' => 'hidden-draft']);

    $this->get(route('contact'))
        ->assertOk()
        ->assertSee('Send enquiry')
        ->assertSee('Architecture')
        ->assertDontSee('Hidden Draft');
});

test('a valid enquiry is stored with a new status and a hashed ip', function () {
    Mail::fake();

    $this->post(route('contact.store'), validEnquiry())
        ->assertRedirect(route('contact').'#enquiry')
        ->assertSessionHas('enquiry_sent');

    $enquiry = ContactEnquiry::sole();
    expect($enquiry->email)->toBe('ada@example.com')
        ->and($enquiry->status)->toBe(EnquiryStatus::New)
        ->and($enquiry->ip_hash)->toHaveLength(64)
        ->and($enquiry->ip_hash)->not->toBe('127.0.0.1');
});

test('required fields and formats are validated on the server', function () {
    $this->post(route('contact.store'), validEnquiry(['name' => '', 'email' => 'nope', 'message' => 'short', 'phone' => 'abc', 'service' => 'Not a service']))
        ->assertSessionHasErrors(['name', 'email', 'message', 'phone', 'service']);

    expect(ContactEnquiry::count())->toBe(0);
});

test('errors are shown accessibly and input is kept', function () {
    $this->from(route('contact'))->followingRedirects()
        ->post(route('contact.store'), validEnquiry(['email' => 'nope']))
        ->assertSee('role="alert"', false)
        ->assertSee('aria-invalid="true"', false)
        ->assertSee('Ada Obi');
});

test('the notification goes to the configured recipient', function () {
    Mail::fake();
    SiteSetting::create(['company_name' => 'CRL', 'enquiry_recipient' => 'office@example.com']);

    $this->post(route('contact.store'), validEnquiry());

    Mail::assertSent(NewContactEnquiry::class, fn ($mail) => $mail->hasTo('office@example.com') && $mail->hasReplyTo('ada@example.com'));
});

test('an enquiry is still stored when no recipient is configured or mail fails', function () {
    Mail::fake();
    $this->post(route('contact.store'), validEnquiry())->assertSessionHas('enquiry_sent');
    Mail::assertNothingSent();

    SiteSetting::create(['company_name' => 'CRL', 'enquiry_recipient' => 'office@example.com']);
    Mail::shouldReceive('to')->andThrow(new RuntimeException('smtp down'));
    $this->post(route('contact.store'), validEnquiry(['email' => 'b@example.com']))->assertSessionHas('enquiry_sent');

    expect(ContactEnquiry::count())->toBe(2);
});

test('the honeypot silently discards bot submissions', function () {
    Mail::fake();

    $this->post(route('contact.store'), validEnquiry(['homepage_url' => 'http://spam.test']))
        ->assertSessionHas('enquiry_sent');

    expect(ContactEnquiry::count())->toBe(0);
    Mail::assertNothingSent();
});

test('submissions are rate limited', function () {
    Mail::fake();

    foreach (range(1, 5) as $i) {
        $this->post(route('contact.store'), validEnquiry())->assertRedirect();
    }

    $this->post(route('contact.store'), validEnquiry())->assertTooManyRequests();
});
