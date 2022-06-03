<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Action
{
    public function execute()
    {
        $this->setUser(User::create([
            'name' => $this->request()->input('name'),
            'email' => $this->request()->input('email'),
            'password' => Hash::make($this->request()->input('password')),
        ]));
    }
}
