<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Weather\Data;

use BaseCodeOy\Yr\Weather\Data\TimeSeriesItemDataSummary;

it('can create a TimeSeriesItemDataSummary instance from response data', function (): void {
    $data = [
        'symbol_code' => 'test_symbol_code',
    ];

    $timeSeriesItemDataSummary = TimeSeriesItemDataSummary::fromResponse($data);

    expect($timeSeriesItemDataSummary->symbolCode)->toBe($data['symbol_code']);
});
