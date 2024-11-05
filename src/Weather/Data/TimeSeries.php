<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Weather\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

final class TimeSeries extends Data
{
    /**
     * @param Collection<int, TimeSeriesItem> $items
     */
    private function __construct(
        public readonly Collection $items,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            items: collect($data)
                ->map(
                    callback: fn (array $item): TimeSeriesItem => TimeSeriesItem::fromResponse($item),
                ),
        );
    }
}
