<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

final class Links extends Data
{
    /**
     * @param Collection<int, Link> $location
     */
    private function __construct(
        public readonly Link $self,
        public readonly ?Link $page,
        public readonly ?Link $search,
        public readonly ?Collection $location,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            self: Link::fromResponse($data['self']),
            page: isset($data['page']) ? Link::fromResponse($data['page']) : null,
            search: isset($data['search']) ? Link::fromResponse($data['search']) : null,
            location: isset($data['location'])
                ? collect($data['location'])->mapWithKeys(fn (array $value, string $key) => [$key => Link::fromResponse($value)])
                : null,
        );
    }
}
