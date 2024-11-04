<?php

declare(strict_types=1);

namespace Tests\Unit\Location\Data;

use BaseCodeOy\Yr\Location\Data\Subregion;

it('can create a Subregion instance from response data', function (): void {
    $data = [
        'id' => 'test_id',
        'name' => 'test_name',
    ];

    $subregion = Subregion::fromResponse($data);

    expect($subregion->id)->toBe($data['id']);
    expect($subregion->name)->toBe($data['name']);
});
