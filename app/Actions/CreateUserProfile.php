<?php

namespace App\Actions;

class CreateUserProfile extends Action
{
    public function execute()
    {
        $this->getUser()->profile()->create();
    }
}
