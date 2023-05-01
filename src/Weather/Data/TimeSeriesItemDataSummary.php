<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Weather\Data;

use Spatie\LaravelData\Data;

final class TimeSeriesItemDataSummary extends Data
{
    private function __construct(
        public readonly string $symbolCode,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            symbolCode: $data['symbol_code'],
        );
    }
}
