<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
            page: \array_key_exists('page', $data) ? Link::fromResponse($data['page']) : null,
            search: \array_key_exists('search', $data) ? Link::fromResponse($data['search']) : null,
            location: \array_key_exists('location', $data)
                ? collect($data['location'])->mapWithKeys(fn (array $value, string $key) => [$key => Link::fromResponse($value)])
                : null,
        );
    }
}
