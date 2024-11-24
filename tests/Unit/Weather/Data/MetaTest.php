<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Weather\Data;

use BaseCodeOy\Yr\Weather\Data\Meta;
use BaseCodeOy\Yr\Weather\Data\MetaUnit;
use Carbon\CarbonImmutable;

it('can create a Meta instance from response data', function (): void {
    $data = [
        'updated_at' => '2023-05-01T00:00:00+00:00',
        'units' => [
            'test_key_1' => 'test_value_1',
            'test_key_2' => 'test_value_2',
        ],
    ];

    $meta = Meta::fromResponse($data);

    expect($meta->lastModified)->toBeInstanceOf(CarbonImmutable::class);
    expect($meta->lastModified->toIso8601String())->toBe($data['updated_at']);

    $expectedUnits = collect($data['units'])
        ->map(
            callback: fn (string $value, string $key): MetaUnit => MetaUnit::fromResponse([
                'key' => $key,
                'value' => $value,
            ]),
        );

    expect($meta->units)->toHaveCount($expectedUnits->count());

    foreach ($meta->units as $index => $unit) {
        expect($unit->key)->toBe($expectedUnits[$index]->key);
        expect($unit->value)->toBe($expectedUnits[$index]->value);
    }
});
