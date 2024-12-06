<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Yr\Weather\Data;

use Spatie\LaravelData\Data;

final class Properties extends Data
{
    private function __construct(
        public readonly Meta $meta,
        public readonly TimeSeries $timeseries,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            meta: Meta::fromResponse($data['meta']),
            timeseries: TimeSeries::fromResponse($data['timeseries']),
        );
    }
}
