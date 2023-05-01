<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Weather\Data;

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
