<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location\Facades;

use Illuminate\Support\Facades\Facade;

final class Location extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'yr.location';
    }
}
