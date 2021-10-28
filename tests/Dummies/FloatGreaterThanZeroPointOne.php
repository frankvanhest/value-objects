<?php

namespace FrankVanHest\ValueObjects\Tests\Dummies;

use FrankVanHest\ValueObjects\Abstracts\FloatValueObject;
use InvalidArgumentException;

final class FloatGreaterThanZeroPointOne extends FloatValueObject
{
    protected static function assert(float $float): void
    {
        if ($float > 0.1) {
            return;
        }

        throw new InvalidArgumentException('Value should be greater than zero point one');
    }
}
