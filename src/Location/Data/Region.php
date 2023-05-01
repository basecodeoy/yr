<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Location\Data;

use Spatie\LaravelData\Data;

final class Region extends Data
{
    private function __construct(
        public readonly string $id,
        public readonly string $name,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
        );
    }
}
