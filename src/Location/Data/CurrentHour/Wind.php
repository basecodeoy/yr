<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location\Data\CurrentHour;

use Spatie\LaravelData\Data;

final class Wind extends Data
{
    private function __construct(
        public readonly float $direction,
        public readonly float $speed,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            direction: $data['direction'],
            speed: $data['speed'],
        );
    }
}
