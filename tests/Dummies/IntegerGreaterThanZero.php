<?php

namespace FrankVanHest\ValueObjects\Tests\Dummies;

use FrankVanHest\ValueObjects\Abstracts\IntegerValueObject;
use InvalidArgumentException;

final readonly class IntegerGreaterThanZero extends IntegerValueObject
{
    protected function assert(int $value): void
    {
        if ($value > 0) {
            return;
        }

        throw new InvalidArgumentException('Value should be greater than zero');
    }
}
