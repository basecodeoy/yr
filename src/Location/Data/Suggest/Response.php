<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location\Data\Suggest;

use BaseCodeOy\Yr\Location\Data\Links;
use BaseCodeOy\Yr\Location\Data\Location;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

final class Response extends Data
{
    /**
     * @param Collection<int, Location> $items
     */
    private function __construct(
        public readonly int $totalResults,
        public readonly Links $links,
        public readonly Collection $items,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            totalResults: $data['totalResults'],
            links: Links::fromResponse($data['_links']),
            items: collect($data['_embedded']['location'])
                ->map(fn (array $value) => Location::fromResponse($value)),
        );
    }
}
