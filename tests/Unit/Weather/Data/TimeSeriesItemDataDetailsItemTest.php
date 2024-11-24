<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Weather\Data;

use BaseCodeOy\Yr\Weather\Data\TimeSeriesItemDataDetailsItem;

it('can create a TimeSeriesItemDataDetailsItem instance from response data', function (): void {
    $data = [
        'key' => 'test_key',
        'value' => 123.45,
    ];

    $timeSeriesItemDataDetailsItem = TimeSeriesItemDataDetailsItem::fromResponse($data);

    expect($timeSeriesItemDataDetailsItem->key)->toBe($data['key']);
    expect($timeSeriesItemDataDetailsItem->value)->toBe($data['value']);
});
