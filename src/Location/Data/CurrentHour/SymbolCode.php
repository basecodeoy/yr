<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Location\Data\CurrentHour;

use Spatie\LaravelData\Data;

final class SymbolCode extends Data
{
    private function __construct(
        public readonly string $key,
        public readonly string $value,
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
