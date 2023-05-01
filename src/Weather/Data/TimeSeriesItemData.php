<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Weather\Data;

use Spatie\LaravelData\Data;

final class TimeSeriesItemData extends Data
{
    private function __construct(
        public readonly ?TimeSeriesItemDataSummary $summary = null,
        public readonly ?TimeSeriesItemDataDetails $details = null,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            summary: isset($data['summary']) ? TimeSeriesItemDataSummary::fromResponse($data['summary']) : null,
            details: isset($data['details']) ? TimeSeriesItemDataDetails::fromResponse($data['details']) : null,
        );
    }
}
