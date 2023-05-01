<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Weather\Data;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

final class Meta extends Data
{
    /**
     * @param Collection<int, MetaUnit> $units
     */
    private function __construct(
        public readonly CarbonImmutable $lastModified,
        public readonly Collection $units,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            lastModified: CarbonImmutable::parse($data['updated_at']),
            units: collect($data['units'])
                ->map(
                    callback: fn (string $value, string $key): MetaUnit => MetaUnit::fromResponse([
                        'key' => $key,
                        'value' => $value,
                    ]),
                ),
        );
    }
}
