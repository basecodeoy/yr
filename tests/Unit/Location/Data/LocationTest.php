<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Location\Data;

use BaseCodeOy\Yr\Location\Data\Category;
use BaseCodeOy\Yr\Location\Data\Country;
use BaseCodeOy\Yr\Location\Data\Link;
use BaseCodeOy\Yr\Location\Data\Location;
use BaseCodeOy\Yr\Location\Data\Position;
use BaseCodeOy\Yr\Location\Data\Region;
use BaseCodeOy\Yr\Location\Data\Subregion;
use Illuminate\Support\Collection;

it('can create a Location instance from response data', function (): void {
    $data = [
        'category' => [
            'id' => 'test_category_id',
            'name' => 'test_category_name',
        ],
        'id' => 'test_id',
        'name' => 'test_name',
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
                'href' => '/test_self_href',
            ],
            'page' => [
                'href' => '/test_page_href',
            ],
            'search' => [
                'href' => '/test_search_href',
            ],
        ],
    ];

    $location = Location::fromResponse($data);

    expect($location->category)->toBeInstanceOf(Category::class);
    expect($location->id)->toBe($data['id']);
    expect($location->name)->toBe($data['name']);
    expect($location->position)->toBeInstanceOf(Position::class);
    expect($location->elevation)->toBe($data['elevation']);
    expect($location->timeZone)->toBe($data['timeZone']);
    expect($location->urlPath)->toBe($data['urlPath']);
    expect($location->country)->toBeInstanceOf(Country::class);
    expect($location->region)->toBeInstanceOf(Region::class);
    expect($location->subregion)->toBeInstanceOf(Subregion::class);
    expect($location->isInOcean)->toBe($data['isInOcean']);

    expect($location->links)->toBeInstanceOf(Collection::class)->and(fn ($links) => expect($links['self'])->toBeInstanceOf(Link::class));
    expect($location->links['self']->href)->toBe('https://www.yr.no'.$data['_links']['self']['href']);
});
