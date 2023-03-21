<?php

namespace FrankVanHest\ValueObjects\Tests\Dummies;

use FrankVanHest\ValueObjects\Abstracts\FloatValueObject;
use InvalidArgumentException;

final readonly class FloatGreaterThanZeroPointOne extends FloatValueObject
{
    protected function assert(float $value): void
    {
        if ($value > 0.1) {
            return;
        }

        throw new InvalidArgumentException('Value should be greater than zero point one');
    }
}
