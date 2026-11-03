<?php

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('guests are sent to login', function () {
    get('/admin-tools/storage-link')->assertRedirect();
});

test('editors are forbidden', function () {
    actingAs(User::factory()->create(['role' => UserRole::Editor]))
        ->get('/admin-tools/storage-link')->assertForbidden();
});

test('admins get a result message', function () {
    actingAs(User::factory()->create(['role' => UserRole::Admin]))
        ->get('/admin-tools/storage-link')->assertOk();
});
