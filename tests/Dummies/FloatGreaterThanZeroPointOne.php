<?php

namespace FrankVanHest\ValueObjects\Tests\Dummies;

use FrankVanHest\ValueObjects\Abstracts\FloatValueObject;
use InvalidArgumentException;

final class FloatGreaterThanZeroPointOne extends FloatValueObject
{
    protected function assert(float $value): void
    {
        if ($value > 0.1) {
            return;
        }

        throw new InvalidArgumentException('Value should be greater than zero point one');
    }

    protected function alterValueBeforeConstructing(float $value): float
    {
        return $value <= 0.1 ? $value : $value + 10;
    }
}
