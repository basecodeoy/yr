<?php

declare(strict_types=1);

namespace Tests\Unit\Location\Data;

use BombenProdukt\Yr\Location\Data\Category;

it('can create a Category instance from response data', function (): void {
    $data = [
        'id' => 'test_id',
        'name' => 'test_name',
    ];

    $category = Category::fromResponse($data);

    expect($category->id)->toBe($data['id']);
    expect($category->name)->toBe($data['name']);
});
