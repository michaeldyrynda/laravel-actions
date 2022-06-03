<?php

use App\Actions\CreateUser;
use App\Models\User;
use App\Traveler;
use Illuminate\Support\Facades\Request;

test('example', function () {
    $traveler = new Traveler(Request::make([
        'name' => 'Michael',
        'email' => 'bizarro@michael.com',
        'password' => 'secret',
    ]));

    CreateUser::make($traveler)->excute();

    expect(User::firstWhere('email', 'bizarro@michael.com'))
        ->not()->toBeNull();
});
