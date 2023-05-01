<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Weather\Data;

use Spatie\LaravelData\Data;

final class TimeSeriesItemDataDetailsItem extends Data
{
    private function __construct(
        public readonly string $key,
        public readonly float $value,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            key: $data['key'],
            value: $data['value'],
        );
    }
}
