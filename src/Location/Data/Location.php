<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Location\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

final class Location extends Data
{
    /**
     * @param Collection<int, Link> $links
     */
    private function __construct(
        public readonly Category $category,
        public readonly string $id,
        public readonly string $name,
        public readonly Position $position,
        public readonly float $elevation,
        public readonly string $timeZone,
        public readonly string $urlPath,
        public readonly Country $country,
        public readonly Region $region,
        public readonly ?Subregion $subregion,
        public readonly bool $isInOcean,
        public readonly Collection $links,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            category: Category::fromResponse($data['category']),
            id: $data['id'],
            name: $data['name'],
            position: Position::fromResponse($data['position']),
            elevation: $data['elevation'],
            timeZone: $data['timeZone'],
            urlPath: $data['urlPath'],
            country: Country::fromResponse($data['country']),
            region: Region::fromResponse($data['region']),
            subregion: isset($data['subregion']) ? Subregion::fromResponse($data['subregion']) : null,
            isInOcean: $data['isInOcean'],
            links: collect($data['_links'])
                ->mapWithKeys(function (array $value, string $key): array {
                    if (\count($value) > 1) {
                        return [
                            $key => collect($value)
                                ->mapWithKeys(fn (array $childValue, string $childKey): array => [$childKey => Link::fromResponse($childValue)]),
                        ];
                    }

                    return [$key => Link::fromResponse($value)];
                }),
        );
    }
}
