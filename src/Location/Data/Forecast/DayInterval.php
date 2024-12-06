<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
