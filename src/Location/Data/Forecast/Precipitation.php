<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Location\Data\Forecast;

use Spatie\LaravelData\Data;

final class Precipitation extends Data
{
    private function __construct(
        public readonly float $value,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            value: $data['value'],
        );
    }
}
