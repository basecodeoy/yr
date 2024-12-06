<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Yr\Location\Data\Forecast;

use Spatie\LaravelData\Data;

final class Symbol extends Data
{
    private function __construct(
        public readonly bool $sunup,
        public readonly float $n,
        public readonly float $clouds,
        public readonly ?string $precipPhase,
        public readonly float $precip,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            sunup: $data['sunup'],
            n: $data['n'],
            clouds: $data['clouds'],
            precipPhase: $data['precipPhase'] ?? null,
            precip: $data['precip'],
        );
    }
}
