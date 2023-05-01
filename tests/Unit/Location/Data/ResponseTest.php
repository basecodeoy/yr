<?php

declare(strict_types=1);

namespace Tests\Unit\Location\Data;

use BombenProdukt\Yr\Location\Data\Links;
use BombenProdukt\Yr\Location\Data\Location;
use BombenProdukt\Yr\Location\Data\Response;
use Illuminate\Support\Collection;

it('can create a Response instance from response data', function (): void {
    $data = [
        'totalResults' => 2,
        '_links' => [
            'self' => [
                'href' => '/test_self_href',
            ],
            'page' => [
                'href' => '/test_page_href',
            ],
            'search' => [
                'href' => '/test_search_href',
            ],
            'location' => [
                [
                    'href' => '/test_search_href',
                ],
            ],
        ],
        '_embedded' => [
            'location' => [
                [
                    'category' => [
                        'id' => 'test_category_id',
                        'name' => 'test_category_name',
                    ],
                    'id' => 'test_id_1',
                    'name' => 'test_name_1',
                    'position' => [
                        'lat' => 12.345,
                        'lon' => 67.890,
                    ],
                    'elevation' => 123.45,
                    'timeZone' => 'test_time_zone',
                    'urlPath' => 'test_url_path',
                    'country' => [
                        'id' => 'test_country_id',
                        'name' => 'test_country_name',
                    ],
                    'region' => [
                        'id' => 'test_region_id',
                        'name' => 'test_region_name',
                    ],
                    'subregion' => [
                        'id' => 'test_subregion_id',
                        'name' => 'test_subregion_name',
                    ],
                    'isInOcean' => false,
                    '_links' => [
                        'self' => [
                            'href' => '/test_self_href_1',
                        ],
                    ],
                ],
                [
                    'category' => [
                        'id' => 'test_category_id',
                        'name' => 'test_category_name',
                    ],
                    'id' => 'test_id_2',
                    'name' => 'test_name_2',
                    'position' => [
                        'lat' => 12.345,
                        'lon' => 67.890,
                    ],
                    'elevation' => 123.45,
                    'timeZone' => 'test_time_zone',
                    'urlPath' => 'test_url_path',
                    'country' => [
                        'id' => 'test_country_id',
                        'name' => 'test_country_name',
                    ],
                    'region' => [
                        'id' => 'test_region_id',
                        'name' => 'test_region_name',
                    ],
                    'subregion' => [
                        'id' => 'test_subregion_id',
                        'name' => 'test_subregion_name',
                    ],
                    'isInOcean' => false,
                    '_links' => [
                        'self' => [
                            'href' => '/test_self_href_2',
                        ],
                    ],
                ],
            ],
        ],
    ];

    $response = Response::fromResponse($data);

    expect($response->totalResults)->toBe($data['totalResults']);
    expect($response->links)->toBeInstanceOf(Links::class);
    expect($response->items)->toBeInstanceOf(Collection::class)->and(fn ($items) => expect($items)->toHaveCount(2));
    expect($response->items[0])->toBeInstanceOf(Location::class);
    expect($response->items[1])->toBeInstanceOf(Location::class);
    expect($response->items[0]->id)->toBe('test_id_1');
    expect($response->items[1]->id)->toBe('test_id_2');
});

it('returns an empty collection when no locations are found', function (): void {
    $data = [
        'totalResults' => 0,
        '_links' => [
            'self' => [
                'href' => '/test_self_href',
            ],
            'page' => [
                'href' => '/test_page_href',
            ],
            'search' => [
                'href' => '/test_search_href',
            ],
            'location' => [
                [
                    'href' => '/test_search_href',
                ],
            ],
        ],
        '_embedded' => [
            'location' => [],
        ],
    ];

    $response = Response::fromResponse($data);

    expect($response->totalResults)->toBe($data['totalResults']);
    expect($response->items)->toBeInstanceOf(Collection::class)->and(fn ($items) => expect($items)->toHaveCount(0));
});
