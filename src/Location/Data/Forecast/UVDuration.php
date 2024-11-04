<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location\Data\Forecast;

use Spatie\LaravelData\Data;

final class UVDuration extends Data
{
    private function __construct(
        public readonly float $days,
        public readonly float $hours,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            days: $data['days'],
            hours: $data['hours'],
        );
    }
}
