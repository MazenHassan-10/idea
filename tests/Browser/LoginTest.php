<?php

use App\Models\User;

it('log in a user', function () {
    $user = User::factory()->create(['password' => '12345678']);

    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', '12345678')
        ->click('@login-button')
        ->assertRoute('idea.index');

    $this->assertAuthenticated();

});

it('log out a user', function () {

    $user = User::factory()->create();

    $this->actingAs($user);

    visit('/')
        ->click('Log Out');

    $this->assertGuest();

});
