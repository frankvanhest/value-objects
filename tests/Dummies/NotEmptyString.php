<?php

namespace FrankVanHest\ValueObjects\Tests\Dummies;

use FrankVanHest\ValueObjects\Abstracts\StringValueObject;
use InvalidArgumentException;

final class NotEmptyString extends StringValueObject
{
    protected function assert(string $value): void
    {
        if (!empty($value)) {
            return;
        }

        throw new InvalidArgumentException('Empty value is not allowed');
    }

    protected function alterValueBeforeConstructing(string $value): string
    {
        return empty($value) ? $value : $value . 'Modified';
    }
}
