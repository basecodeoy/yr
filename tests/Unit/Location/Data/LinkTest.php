<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Location\Data;

use BaseCodeOy\Yr\Location\Data\Link;

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
