<?php

namespace App\Actions;

use App\Events\UserWasCreated;

class AddToMixpanel extends Action
{
    public function execute()
    {
        UserWasCreated::dispatch($this->getUser());
    }
}
