<?php

namespace App\Concerns;

trait Makeable
{
    public static function make(...$arguments): self
    {
        return new static(...$arguments);
    }
}
