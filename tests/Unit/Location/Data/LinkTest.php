<?php

declare(strict_types=1);

namespace Tests\Unit\Location\Data;

use BombenProdukt\Yr\Location\Data\Link;

it('can create a Link instance from response data', function (): void {
    $data = [
        'href' => '/test_href',
        'templated' => true,
    ];

    $link = Link::fromResponse($data);

    expect($link->href)->toBe('https://www.yr.no'.$data['href']);
    expect($link->templated)->toBe($data['templated']);
});

it('can create a Link instance with a default templated value', function (): void {
    $data = [
        'href' => '/test_href',
    ];

    $link = Link::fromResponse($data);

    expect($link->href)->toBe('https://www.yr.no'.$data['href']);
    expect($link->templated)->toBe(false);
});
