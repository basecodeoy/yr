<?php

declare(strict_types=1);

namespace Tests\Unit\Location\Data;

use BombenProdukt\Yr\Location\Data\Region;

it('can create a Region instance from response data', function (): void {
    $data = [
        'id' => 'test_id',
        'name' => 'test_name',
    ];

    $region = Region::fromResponse($data);

    expect($region->id)->toBe($data['id']);
    expect($region->name)->toBe($data['name']);
});
