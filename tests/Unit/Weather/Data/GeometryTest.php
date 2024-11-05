<?php

declare(strict_types=1);

namespace Tests\Unit\Weather\Data;

use BaseCodeOy\Yr\Weather\Data\Geometry;

it('can create a Geometry instance from response data', function (): void {
    $data = [
        'type' => 'test_type',
        'coordinates' => [12.345, 67.890],
    ];

    $geometry = Geometry::fromResponse($data);

    expect($geometry->type)->toBe($data['type']);
    expect($geometry->coordinates)->toBe($data['coordinates']);
});
