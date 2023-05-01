<?php

declare(strict_types=1);

namespace BombenProdukt\Yr;

use BombenProdukt\PackagePowerPack\Package\AbstractServiceProvider;

final class ServiceProvider extends AbstractServiceProvider
{
    public function packageRegistered(): void
    {
        $this->app->singleton('yr.location', Location\Client::class);
        $this->app->singleton('yr.weather', Weather\Client::class);
    }
}
