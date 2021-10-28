<?php

namespace FrankVanHest\ValueObjects\Tests\Dummies;

use FrankVanHest\ValueObjects\Abstracts\IntegerValueObject;
use InvalidArgumentException;

final class IntegerGreaterThanZero extends IntegerValueObject
{
    protected static function assert(int $integer): void
    {
        if ($integer > 0) {
            return;
        }

        throw new InvalidArgumentException('Value should be greater than zero');
    }
}
