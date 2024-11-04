<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location\Data\CurrentHour;

use Spatie\LaravelData\Data;

final class Temperature extends Data
{
    private function __construct(
        public readonly float $value,
        public readonly float $feelsLike,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            value: $data['value'],
            feelsLike: $data['feelsLike'],
        );
    }
}
