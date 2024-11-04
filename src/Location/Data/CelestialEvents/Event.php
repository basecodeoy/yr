<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location\Data\CelestialEvents;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Data;

final class Event extends Data
{
    private function __construct(
        public readonly string $body,
        public readonly CarbonImmutable $time,
        public readonly string $type,
        public readonly ?float $value,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            body: $data['body'],
            time: CarbonImmutable::parse($data['time']),
            type: $data['type'],
            value: $data['value'] ?? null,
        );
    }
}
