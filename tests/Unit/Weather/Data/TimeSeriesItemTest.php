<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Weather\Data;

use BaseCodeOy\Yr\Weather\Data\TimeSeriesItem;
use BaseCodeOy\Yr\Weather\Data\TimeSeriesItemData;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

it('can create a TimeSeriesItem instance from response data', function (): void {
    $data = [
        'time' => '2023-05-01T12:00:00Z',
        'data' => [
            'instant' => [
                'details' => [
                    'air_temperature' => 15.0,
                ],
            ],
            'next_1_hours' => [
                'summary' => [
                    'symbol_code' => 'clearsky_day',
                ],
                'details' => [
                    'precipitation_amount' => 0.0,
                ],
            ],
        ],
    ];

    $timeSeriesItem = TimeSeriesItem::fromResponse($data);

    expect($timeSeriesItem->time)->toBeInstanceOf(CarbonImmutable::class);
    expect($timeSeriesItem->data)->toBeInstanceOf(Collection::class);

    $expectedTime = CarbonImmutable::parse($data['time']);
    $timeSeriesItemData = TimeSeriesItemData::fromResponse($data['data']['instant']);
    $expectedNext1HoursData = TimeSeriesItemData::fromResponse($data['data']['next_1_hours']);

    expect($timeSeriesItem->time->equalTo($expectedTime))->toBeTrue();
    expect($timeSeriesItem->data->get('instant'))->toEqual($timeSeriesItemData);
    expect($timeSeriesItem->data->get('next_1_hours'))->toEqual($expectedNext1HoursData);
});
