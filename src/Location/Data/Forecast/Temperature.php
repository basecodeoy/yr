<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location\Data\Forecast;

use Spatie\LaravelData\Data;

final class Temperature extends Data
{
    private function __construct(
        public readonly float $value,
        public readonly float $min,
        public readonly float $max,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            value: $data['value'],
            min: $data['min'],
            max: $data['max'],
        );
    }
}
