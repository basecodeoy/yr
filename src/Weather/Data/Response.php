<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Weather\Data;

use Spatie\LaravelData\Data;

final class Response extends Data
{
    private function __construct(
        public readonly string $type,
        public readonly Geometry $geometry,
        public readonly Properties $properties,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            type: $data['type'],
            geometry: Geometry::fromResponse($data['geometry']),
            properties: Properties::fromResponse($data['properties']),
        );
    }
}
