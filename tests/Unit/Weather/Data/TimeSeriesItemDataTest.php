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

    $timeSeriesItemDataSummary = TimeSeriesItemDataSummary::fromResponse($data['summary']);
    $timeSeriesItemDataDetails = TimeSeriesItemDataDetails::fromResponse($data['details']);

    expect($timeSeriesItemData->summary->symbolCode)->toBe($timeSeriesItemDataSummary->symbolCode);
    expect($timeSeriesItemData->details->items[0]->key)->toBe($timeSeriesItemDataDetails->items[0]->key);
    expect($timeSeriesItemData->details->items[0]->value)->toBe($timeSeriesItemDataDetails->items[0]->value);
});
