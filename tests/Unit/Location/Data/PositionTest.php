<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Location\Data;

use BaseCodeOy\Yr\Location\Data\Position;

it('can create a Position instance from response data', function (): void {
    $data = [
        'lat' => 12.345,
        'lon' => 67.890,
    ];

    $position = Position::fromResponse($data);

    expect($position->lat)->toBe($data['lat']);
    expect($position->lon)->toBe($data['lon']);
});
