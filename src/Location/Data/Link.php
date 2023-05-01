<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Location\Data;

use Spatie\LaravelData\Data;

final class Link extends Data
{
    private function __construct(
        public readonly string $href,
        public readonly bool $templated,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            href: 'https://www.yr.no'.$data['href'],
            templated: $data['templated'] ?? false,
        );
    }
}
