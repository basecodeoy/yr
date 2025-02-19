<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Yr\Weather\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

final class TimeSeriesItemDataDetails extends Data
{
    /**
     * @param Collection<int, TimeSeriesItemDataDetailsItem> $items
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
                    callback: fn (float $value, string $key): TimeSeriesItemDataDetailsItem => TimeSeriesItemDataDetailsItem::fromResponse([
                        'key' => $key,
                        'value' => $value,
                    ]),
                )
                ->values(),
        );
    }
}
