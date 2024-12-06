<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Weather\Data;

use BaseCodeOy\Yr\Weather\Data\TimeSeries;
use BaseCodeOy\Yr\Weather\Data\TimeSeriesItem;
use Illuminate\Support\Collection;

it('can create a TimeSeries instance from response data', function (): void {
    $data = [
        [
            'time' => '2023-05-01T12:00:00Z',
            'data' => [
                'instant' => [
                    'details' => [
                        'air_temperature' => 15.0,
                    ],
                ],
            ],
        ],
        [
            'time' => '2023-05-01T13:00:00Z',
            'data' => [
                'instant' => [
                    'details' => [
                        'air_temperature' => 16.0,
                    ],
                ],
            ],
        ],
    ];

    $timeSeries = TimeSeries::fromResponse($data);

    expect($timeSeries->items)->toBeInstanceOf(Collection::class);

    $timeSeriesItem = TimeSeriesItem::fromResponse($data[0]);
    $expectedSecondItem = TimeSeriesItem::fromResponse($data[1]);

    expect($timeSeries->items->count())->toBe(2);
    expect($timeSeries->items->get(0))->toEqual($timeSeriesItem);
    expect($timeSeries->items->get(1))->toEqual($expectedSecondItem);
});
