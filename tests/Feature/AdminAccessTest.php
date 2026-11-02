<?php

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guests are redirected away from the admin panel', function () {
    $this->get('/admin')->assertRedirect('/admin/login');
});

test('users without a role cannot access the admin panel', function () {
    $this->actingAs(User::factory()->create())->get('/admin')->assertForbidden();
});

test('users with a role can access the admin panel', function () {
    $user = User::factory()->create(['role' => UserRole::Editor]);

    $this->actingAs($user)->get('/admin')->assertOk();
});

test('role cannot be mass assigned', function () {
    $user = new User(['name' => 'X', 'email' => 'x@example.com', 'role' => 'admin']);

    expect($user->role)->toBeNull();
});

test('public registration is disabled', function () {
    $this->get('/register')->assertNotFound();
});
