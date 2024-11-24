<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
