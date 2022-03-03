<?php

namespace FrankVanHest\ValueObjects\Tests\Dummies;

use FrankVanHest\ValueObjects\Abstracts\IntegerValueObject;
use InvalidArgumentException;

final class IntegerGreaterThanZero extends IntegerValueObject
{
    protected function assert(int $value): void
    {
        if ($value > 0) {
            return;
        }

        throw new InvalidArgumentException('Value should be greater than zero');
    }

    protected function alterValueBeforeConstructing(int $value): int
    {
        return $value <= 0 ? $value : $value + 10;
    }
}
