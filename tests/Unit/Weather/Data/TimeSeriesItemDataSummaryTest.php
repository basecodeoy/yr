<?php

declare(strict_types=1);

namespace Tests\Unit\Weather\Data;

use BombenProdukt\Yr\Weather\Data\TimeSeriesItemDataSummary;

it('can create a TimeSeriesItemDataSummary instance from response data', function (): void {
    $data = [
        'symbol_code' => 'test_symbol_code',
    ];

    $timeSeriesItemDataSummary = TimeSeriesItemDataSummary::fromResponse($data);

    expect($timeSeriesItemDataSummary->symbolCode)->toBe($data['symbol_code']);
});
