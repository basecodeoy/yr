<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Yr\Location\Data;

use Spatie\LaravelData\Data;

final class Position extends Data
{
    private function __construct(
        public readonly float $lat,
        public readonly float $lon,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            lat: $data['lat'],
            lon: $data['lon'],
        );
    }
}
