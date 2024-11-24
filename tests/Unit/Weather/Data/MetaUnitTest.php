<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Weather\Data;

use BaseCodeOy\Yr\Weather\Data\MetaUnit;

it('can create a MetaUnit instance from response data', function (): void {
    $data = [
        'key' => 'test_key',
        'value' => 'test_value',
    ];

    $metaUnit = MetaUnit::fromResponse($data);

    expect($metaUnit->key)->toBe($data['key']);
    expect($metaUnit->value)->toBe($data['value']);
});
