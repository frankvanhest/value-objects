<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Tests\Dummies;

use FrankVanHest\ValueObjects\Interfaces\IntegerValueModifier;

final class MultiplyIntegerValue implements IntegerValueModifier
{
    public function __construct(
        private int $integer,
    ) {
    }

    public function modify(int $value): int
    {
        return $this->integer * $value;
    }
}
