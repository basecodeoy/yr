<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location\Data\Forecast;

use Spatie\LaravelData\Data;

final class UV extends Data
{
    private function __construct(
        public readonly UVDuration $duration,
        public readonly string $url,
        public readonly string $displayUrl,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            duration: UVDuration::fromResponse($data['duration']),
            url: $data['url'],
            displayUrl: $data['displayUrl'],
        );
    }
}
