<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Yr;

use BaseCodeOy\Crate\Package\AbstractServiceProvider;

final class ServiceProvider extends AbstractServiceProvider
{
    #[\Override()]
    public function packageRegistered(): void
    {
        $this->app->singleton('yr.location', Location\Client::class);
        $this->app->singleton('yr.weather', Weather\Client::class);
    }
}
