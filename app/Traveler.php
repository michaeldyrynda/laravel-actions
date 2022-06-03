<?php

namespace App;

use App\Models\User;
use Illuminate\Http\Request;

class Traveler
{
    protected ?User $user;

    public function __construct(protected Request $request)
    {
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
