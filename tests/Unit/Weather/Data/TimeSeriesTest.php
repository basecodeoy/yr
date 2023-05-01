<?php

declare(strict_types=1);

namespace Tests\Unit\Weather\Data;

use BombenProdukt\Yr\Weather\Data\TimeSeries;
use BombenProdukt\Yr\Weather\Data\TimeSeriesItem;
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

    $expectedFirstItem = TimeSeriesItem::fromResponse($data[0]);
    $expectedSecondItem = TimeSeriesItem::fromResponse($data[1]);

    expect($timeSeries->items->count())->toBe(2);
    expect($timeSeries->items->get(0))->toEqual($expectedFirstItem);
    expect($timeSeries->items->get(1))->toEqual($expectedSecondItem);
});
