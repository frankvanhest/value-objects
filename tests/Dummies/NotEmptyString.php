<?php

namespace FrankVanHest\ValueObjects\Tests\Dummies;

use FrankVanHest\ValueObjects\Abstracts\StringValueObject;
use InvalidArgumentException;

final class NotEmptyString extends StringValueObject
{
    protected function assert(string $string): void
    {
        if (!empty($string)) {
            return;
        }

        throw new InvalidArgumentException('Empty value is not allowed');
    }
}
