<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Yr\Location\Data;

use Spatie\LaravelData\Data;

final class Link extends Data
{
    private function __construct(
        public readonly string $href,
        public readonly bool $templated,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            href: 'https://www.yr.no'.$data['href'],
            templated: $data['templated'] ?? false,
        );
    }
}
