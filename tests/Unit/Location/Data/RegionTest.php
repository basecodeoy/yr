<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Location\Data;

use BaseCodeOy\Yr\Location\Data\Region;

it('can create a Region instance from response data', function (): void {
    $data = [
        'id' => 'test_id',
        'name' => 'test_name',
    ];

    $region = Region::fromResponse($data);

    expect($region->id)->toBe($data['id']);
    expect($region->name)->toBe($data['name']);
});
