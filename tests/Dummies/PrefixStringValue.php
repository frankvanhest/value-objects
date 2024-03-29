<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Tests\Dummies;

use FrankVanHest\ValueObjects\Interfaces\StringValueModifier;

final readonly class PrefixStringValue implements StringValueModifier
{
    public function __construct(
        private string $string,
    ) {
    }

    public function modify(string $value): string
    {
        return $this->string . $value;
    }
}
