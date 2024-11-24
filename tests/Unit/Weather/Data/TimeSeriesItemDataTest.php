<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Weather\Data;

use BaseCodeOy\Yr\Weather\Data\TimeSeriesItemData;
use BaseCodeOy\Yr\Weather\Data\TimeSeriesItemDataDetails;
use BaseCodeOy\Yr\Weather\Data\TimeSeriesItemDataSummary;

it('can create a TimeSeriesItemData instance from response data', function (): void {
    $data = [
        'summary' => [
            'symbol_code' => 'clearsky_day',
        ],
        'details' => [
            'air_temperature' => 15.0,
        ],
    ];

    $timeSeriesItemData = TimeSeriesItemData::fromResponse($data);

    expect($timeSeriesItemData->summary)->toBeInstanceOf(TimeSeriesItemDataSummary::class);
    expect($timeSeriesItemData->details)->toBeInstanceOf(TimeSeriesItemDataDetails::class);

    $expectedSummary = TimeSeriesItemDataSummary::fromResponse($data['summary']);
    $expectedDetails = TimeSeriesItemDataDetails::fromResponse($data['details']);

    expect($timeSeriesItemData->summary->symbolCode)->toBe($expectedSummary->symbolCode);
    expect($timeSeriesItemData->details->items[0]->key)->toBe($expectedDetails->items[0]->key);
    expect($timeSeriesItemData->details->items[0]->value)->toBe($expectedDetails->items[0]->value);
});
