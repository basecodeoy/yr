<?php

declare(strict_types=1);

namespace Tests\Unit\Weather\Data;

use BaseCodeOy\Yr\Weather\Data\Geometry;
use BaseCodeOy\Yr\Weather\Data\Properties;
use BaseCodeOy\Yr\Weather\Data\Response;

it('can create a Response instance from response data', function (): void {
    $data = [
        'type' => 'Feature',
        'geometry' => [
            'type' => 'Point',
            'coordinates' => [10.0, 20.0],
        ],
        'properties' => [
            'meta' => [
                'updated_at' => '2023-05-01T10:00:00Z',
                'units' => [
                    'air_temperature' => 'celsius',
                ],
            ],
            'timeseries' => [],
        ],
    ];

    $response = Response::fromResponse($data);

    $expectedGeometry = Geometry::fromResponse($data['geometry']);
    $expectedProperties = Properties::fromResponse($data['properties']);

    expect($response->type)->toBe($data['type']);
    expect($response->geometry)->toEqual($expectedGeometry);
    expect($response->properties)->toEqual($expectedProperties);
});
