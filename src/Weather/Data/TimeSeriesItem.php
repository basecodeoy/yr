<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Yr\Weather\Data;

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
