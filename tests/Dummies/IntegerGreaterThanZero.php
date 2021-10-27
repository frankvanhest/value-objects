<?php

namespace FrankVanHest\ValueObjects\Tests\Dummies;

use FrankVanHest\ValueObjects\Abstracts\IntegerValueObject as AbstractIntegerValueObject;
use InvalidArgumentException;

final class IntegerGreaterThanZero extends AbstractIntegerValueObject
{
    protected static function assert(int $integer): void
    {
        if ($integer > 0) {
            return;
        }

        throw new InvalidArgumentException('Value should be greater than zero');
    }
}
