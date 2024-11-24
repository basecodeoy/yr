<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Yr\Location\Data\CelestialEvents;

use BaseCodeOy\Yr\Location\Data\Links;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

final class Response extends Data
{
    /**
     * @param Collection<int, InitialState> $initialStates
     * @param Collection<int, Event>        $events
     */
    private function __construct(
        public readonly CarbonImmutable $start,
        public readonly CarbonImmutable $end,
        public readonly Collection $initialStates,
        public readonly Collection $events,
        public readonly Links $links,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            start: CarbonImmutable::parse($data['start']),
            end: CarbonImmutable::parse($data['end']),
            initialStates: collect($data['initialStates'])->map(fn (array $value) => InitialState::fromResponse($value)),
            events: collect($data['events'])->map(fn (array $value) => Event::fromResponse($value)),
            links: Links::fromResponse($data['_links']),
        );
    }
}
