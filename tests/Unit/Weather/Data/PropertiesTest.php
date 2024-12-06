<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Weather\Data;

use BaseCodeOy\Yr\Weather\Data\Meta;
use BaseCodeOy\Yr\Weather\Data\Properties;
use BaseCodeOy\Yr\Weather\Data\TimeSeries;

it('can create a Properties instance from response data', function (): void {
    $data = [
        'meta' => [
            'updated_at' => '2023-05-01T00:00:00Z',
            'units' => [
                'test_key_1' => 'test_value_1',
                'test_key_2' => 'test_value_2',
            ],
        ],
        'timeseries' => [
            [
                'time' => '2023-05-01T00:00:00Z',
                'data' => [
                    'instant' => [
                        'details' => [
                            'air_temperature' => 15.0,
                        ],
                    ],
                ],
            ],
        ],
    ];

    $properties = Properties::fromResponse($data);

    expect($properties->meta)->toBeInstanceOf(Meta::class);
    expect($properties->timeseries)->toBeInstanceOf(TimeSeries::class);

    $expectedMeta = Meta::fromResponse($data['meta']);
    $timeSeries = TimeSeries::fromResponse($data['timeseries']);

    expect($properties->meta->lastModified->toIso8601String())->toBe($expectedMeta->lastModified->toIso8601String());
    expect($properties->timeseries->items[0]->time->toIso8601String())->toBe($timeSeries->items[0]->time->toIso8601String());
});
