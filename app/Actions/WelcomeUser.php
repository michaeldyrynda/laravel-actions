<?php

namespace App\Actions;

use App\Notifications\WelcomeToActions;

class WelcomeUser extends Action
{
    public function execute()
    {
        $this->getUser()->notify(new WelcomeToActions());
    }
}
