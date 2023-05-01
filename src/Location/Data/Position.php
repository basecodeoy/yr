<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Location\Data;

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
