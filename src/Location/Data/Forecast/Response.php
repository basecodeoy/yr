<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location\Data\Forecast;

use BaseCodeOy\Yr\Location\Data\Links;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

final class Response extends Data
{
    /**
     * @param Collection<int, DayInterval>   $dayIntervals
     * @param Collection<int, ShortInterval> $shortIntervals
     * @param Collection<int, LongInterval>  $longIntervals
     */
    private function __construct(
        public readonly UV $uv,
        public readonly Links $links,
        public readonly Collection $dayIntervals,
        public readonly Collection $shortIntervals,
        public readonly Collection $longIntervals,
        public readonly CarbonImmutable $createdDateTime,
        public readonly CarbonImmutable $updatedDateTime,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            uv: UV::fromResponse($data['uv']),
            dayIntervals: collect($data['dayIntervals'])
                ->mapWithKeys(fn (array $item, string $key) => [$key => DayInterval::fromResponse($item)])
                ->values(),
            shortIntervals: collect($data['shortIntervals'])
                ->mapWithKeys(fn (array $item, string $key) => [$key => ShortInterval::fromResponse($item)])
                ->values(),
            longIntervals: collect($data['longIntervals'])
                ->mapWithKeys(fn (array $item, string $key) => [$key => LongInterval::fromResponse($item)])
                ->values(),
            links: Links::fromResponse($data['_links']),
            createdDateTime: CarbonImmutable::parse($data['created']),
            updatedDateTime: CarbonImmutable::parse($data['update']),
        );
    }
}
