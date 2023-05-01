<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Location\Data\Forecast;

use Spatie\LaravelData\Data;

final class Wind extends Data
{
    private function __construct(
        public readonly float $min,
        public readonly float $max,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            min: $data['min'],
            max: $data['max'],
        );
    }
}
