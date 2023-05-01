<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Weather\Data;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

final class TimeSeriesItem extends Data
{
    /**
     * @param Collection<string, TimeSeriesItemData> $data
     */
    private function __construct(
        public readonly CarbonImmutable $time,
        public readonly Collection $data,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            time: CarbonImmutable::parse($data['time']),
            data: collect($data['data'])
                ->mapWithKeys(
                    callback: fn (array $item, string $key): array => [$key => TimeSeriesItemData::fromResponse($item)],
                ),
        );
    }
}
