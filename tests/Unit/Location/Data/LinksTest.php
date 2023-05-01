<?php

declare(strict_types=1);

namespace Tests\Unit\Location\Data;

use BombenProdukt\Yr\Location\Data\Link;
use BombenProdukt\Yr\Location\Data\Links;
use Illuminate\Support\Collection;

it('can create a Links instance from response data', function (): void {
    $data = [
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
                'href' => '/test_location_href',
            ],
        ],
    ];

    $links = Links::fromResponse($data);

    expect($links->self)->toBeInstanceOf(Link::class);
    expect($links->self->href)->toBe('https://www.yr.no'.$data['self']['href']);

    expect($links->page)->toBeInstanceOf(Link::class);
    expect($links->page->href)->toBe('https://www.yr.no'.$data['page']['href']);

    expect($links->search)->toBeInstanceOf(Link::class);
    expect($links->search->href)->toBe('https://www.yr.no'.$data['search']['href']);

    expect($links->location)->toBeInstanceOf(Collection::class)->and(fn ($location) => expect($location[0])->toBeInstanceOf(Link::class));
    expect($links->location[0]->href)->toBe('https://www.yr.no'.$data['location'][0]['href']);
});
