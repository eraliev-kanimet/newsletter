<?php

namespace App\Services\Abstract;

abstract class Service
{
    public static function x(...$args): static
    {
        return new static(...$args);
    }
}
