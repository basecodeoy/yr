<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Yr\Location\Data\Forecast;

use Spatie\LaravelData\Data;

final class CloudCover extends Data
{
    private function __construct(
        public readonly float $value,
        public readonly float $high,
        public readonly float $middle,
        public readonly float $low,
        public readonly float $fog,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            value: $data['value'],
            high: $data['high'],
            middle: $data['middle'],
            low: $data['low'],
            fog: $data['fog'],
        );
    }
}
