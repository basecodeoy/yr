<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location\Data\CurrentHour;

use BaseCodeOy\Yr\Location\Data\Links;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

final class Response extends Data
{
    /**
     * @param Collection<int, SymbolCode> $symbolCode
     */
    private function __construct(
        public readonly Collection $symbolCode,
        public readonly Temperature $temperature,
        public readonly float $precipitation,
        public readonly Wind $wind,
        public readonly Links $links,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            symbolCode: collect($data['symbolCode'])
                ->mapWithKeys(fn (string $value, string $key) => [$key => SymbolCode::fromResponse([
                    'key' => $key,
                    'value' => $value,
                ])])
                ->values(),
            temperature: Temperature::fromResponse($data['temperature']),
            precipitation: $data['precipitation']['value'],
            wind: Wind::fromResponse($data['wind']),
            links: Links::fromResponse($data['_links']),
        );
    }
}
