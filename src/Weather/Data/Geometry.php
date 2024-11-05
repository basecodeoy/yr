<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Weather\Data;

use Spatie\LaravelData\Data;

final class Geometry extends Data
{
    /**
     * @param array<int, float> $coordinates
     */
    private function __construct(
        public readonly string $type,
        public readonly array $coordinates,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            type: $data['type'],
            coordinates: $data['coordinates'],
        );
    }
}
