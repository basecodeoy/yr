<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Weather\Facades;

use Illuminate\Support\Facades\Facade;

final class Weather extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'yr.weather';
    }
}
