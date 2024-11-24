<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Yr\Weather\Data;

use Spatie\LaravelData\Data;

final class TimeSeriesItemData extends Data
{
    private function __construct(
        public readonly ?TimeSeriesItemDataSummary $summary = null,
        public readonly ?TimeSeriesItemDataDetails $details = null,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            summary: \array_key_exists('summary', $data) ? TimeSeriesItemDataSummary::fromResponse($data['summary']) : null,
            details: \array_key_exists('details', $data) ? TimeSeriesItemDataDetails::fromResponse($data['details']) : null,
        );
    }
}
