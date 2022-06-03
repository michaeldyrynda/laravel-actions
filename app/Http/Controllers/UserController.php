<?php

namespace App\Http\Controllers;

use App\Actions\AddToMixpanel;
use App\Actions\CreateUser;
use App\Actions\CreateUserProfile;
use App\Actions\WelcomeUser;
use App\Traveler;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\App;

class UserController extends Controller
{
    public function store(Request $request)
    {
        return App::make(Pipeline::class)
            ->send(new Traveler($request))
            ->through([
                CreateUser::class,
                CreateUserProfile::class,
                AddToMixpanel::class,
                WelcomeUser::class,
            ])
            ->thenReturn() // Traveler
            ->getUser();
    }
}
