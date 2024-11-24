<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Weather\Data;

use BaseCodeOy\Yr\Weather\Data\TimeSeriesItemDataDetails;
use BaseCodeOy\Yr\Weather\Data\TimeSeriesItemDataDetailsItem;

it('can create a TimeSeriesItemDataDetails instance from response data', function (): void {
    $data = [
        'test_key_1' => 123.45,
        'test_key_2' => 678.90,
    ];

    $timeSeriesItemDataDetails = TimeSeriesItemDataDetails::fromResponse($data);

    $expectedItems = collect($data)
        ->map(
            callback: fn (float $value, string $key): TimeSeriesItemDataDetailsItem => TimeSeriesItemDataDetailsItem::fromResponse([
                'key' => $key,
                'value' => $value,
            ]),
        )
        ->values();

    expect($timeSeriesItemDataDetails->items)->toHaveCount($expectedItems->count());

    foreach ($timeSeriesItemDataDetails->items as $index => $item) {
        expect($item->key)->toBe($expectedItems[$index]->key);
        expect($item->value)->toBe($expectedItems[$index]->value);
    }
});
