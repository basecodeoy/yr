<?php

declare(strict_types=1);

namespace Tests\Unit\Location\Data;

use BaseCodeOy\Yr\Location\Data\Country;

it('can create a Country instance from response data', function (): void {
    $data = [
        'id' => 'test_id',
        'name' => 'test_name',
    ];

    $country = Country::fromResponse($data);

    expect($country->id)->toBe($data['id']);
    expect($country->name)->toBe($data['name']);
});
