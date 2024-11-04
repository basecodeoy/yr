<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location\Data\CelestialEvents;

use Spatie\LaravelData\Data;

final class InitialState extends Data
{
    private function __construct(
        public readonly string $body,
        public readonly string $horizonState,
        public readonly string $polarState,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            body: $data['body'],
            horizonState: $data['horizonState'],
            polarState: $data['polarState'],
        );
    }
}
