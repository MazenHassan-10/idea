<?php

use Illuminate\Support\Facades\Auth;

it('registers a user', function () {

    visit('/register')
        ->fill('name', 'mazen')
        ->fill('email', 'mazen@ex1.com')
        ->fill('password', '12345678')
        ->click('Create Account')
        ->assertPathIs('/');

    $this->assertAuthenticated();

    expect(Auth::user())->toMatchArray([
        'name' => 'mazen',
        'email' => 'mazen@ex1.com',
    ]);
});
