<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Yr\Location\Data;

use Spatie\LaravelData\Data;

final class Region extends Data
{
    private function __construct(
        public readonly string $id,
        public readonly string $name,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
        );
    }
}
