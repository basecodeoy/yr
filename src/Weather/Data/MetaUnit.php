<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Yr\Weather\Data;

use Spatie\LaravelData\Data;

final class MetaUnit extends Data
{
    private function __construct(
        public readonly string $key,
        public readonly string $value,
    ) {
        //
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            key: $data['key'],
            value: $data['value'],
        );
    }
}
