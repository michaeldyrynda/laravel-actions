<?php

use App\Events\UserWasCreated;
use App\Models\User;
use App\Notifications\WelcomeToActions;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

it('can register a new user', function () {
    test()
        ->post(route('users.store'), [
            'name' => 'Michael Dyrynda',
            'email' => 'michael@dyrynda.com.au',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ])
        ->assertCreated();
});

it('creates a profile for a new user', function () {
    test()
        ->post(route('users.store'), [
            'name' => 'Michael Dyrynda',
            'email' => 'michael@dyrynda.com.au',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ])
        ->assertCreated();

    $user = User::firstWhere('email', 'michael@dyrynda.com.au');

    expect($user)
        ->not()->toBeNull()
        ->profile->not()->toBeNull();
});

it('logs creation of user in mixpanel', function () {
    Event::fake(UserWasCreated::class);

    test()
        ->post(route('users.store'), [
            'name' => 'Michael Dyrynda',
            'email' => 'michael@dyrynda.com.au',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ])
        ->assertCreated();

    Event::assertDispatched(function (UserWasCreated $event) {
        return $event->user->email === 'michael@dyrynda.com.au';
    });
});

it('welcomes the user to our app', function () {
    Notification::fake();

    test()
        ->post(route('users.store'), [
            'name' => 'Michael Dyrynda',
            'email' => 'michael@dyrynda.com.au',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ])
        ->assertCreated();

    $user = User::firstWhere('email', 'michael@dyrynda.com.au');

    Notification::assertSentTo([$user], WelcomeToActions::class);
});
