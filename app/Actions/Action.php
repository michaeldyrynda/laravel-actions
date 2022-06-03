<?php

namespace App\Actions;

use App\Concerns\Makeable;
use App\Traveler;

abstract class Action
{
    use Makeable;

    abstract public function execute();

    public function __construct(protected Traveler $traveler)
    {
    }

    public function __invoke(Traveler $traveler, callable $next)
    {
        static::make($traveler)->execute();

        return $next($traveler);
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->traveler, $name)) {
            return $this->traveler->{$name}(...$arguments);
        }
    }
}
