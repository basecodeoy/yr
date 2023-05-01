<?php

declare(strict_types=1);

namespace Tests\Unit\Weather\Data;

use BombenProdukt\Yr\Weather\Data\TimeSeriesItem;
use BombenProdukt\Yr\Weather\Data\TimeSeriesItemData;
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
    $expectedInstantData = TimeSeriesItemData::fromResponse($data['data']['instant']);
    $expectedNext1HoursData = TimeSeriesItemData::fromResponse($data['data']['next_1_hours']);

    expect($timeSeriesItem->time->equalTo($expectedTime))->toBeTrue();
    expect($timeSeriesItem->data->get('instant'))->toEqual($expectedInstantData);
    expect($timeSeriesItem->data->get('next_1_hours'))->toEqual($expectedNext1HoursData);
});
