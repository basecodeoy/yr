<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Weather\Data;

use Spatie\LaravelData\Data;

final class MetaUnit extends Data
{
    private function __construct(
        public readonly string $key,
        public readonly string $value,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            key: $data['key'],
            value: $data['value'],
        );
    }
}
