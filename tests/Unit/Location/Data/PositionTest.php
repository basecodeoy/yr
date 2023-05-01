<?php

declare(strict_types=1);

namespace Tests\Unit\Location\Data;

use BombenProdukt\Yr\Location\Data\Position;

it('can create a Position instance from response data', function (): void {
    $data = [
        'lat' => 12.345,
        'lon' => 67.890,
    ];

    $position = Position::fromResponse($data);

    expect($position->lat)->toBe($data['lat']);
    expect($position->lon)->toBe($data['lon']);
});
