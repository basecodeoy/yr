<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location\Data\Forecast;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Data;

final class DayInterval extends Data
{
    private function __construct(
        public readonly CarbonImmutable $start,
        public readonly CarbonImmutable $end,
        public readonly string $twentyFourHourSymbol,
        public readonly array $sixHourSymbols,
        public readonly float $precipitation,
        public readonly Temperature $temperature,
        public readonly Wind $wind,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            start: CarbonImmutable::parse($data['start']),
            end: CarbonImmutable::parse($data['end']),
            twentyFourHourSymbol: $data['twentyFourHourSymbol'],
            sixHourSymbols: $data['sixHourSymbols'],
            precipitation: $data['precipitation']['value'],
            temperature: Temperature::fromResponse($data['temperature']),
            wind: Wind::fromResponse($data['wind']),
        );
    }
}
