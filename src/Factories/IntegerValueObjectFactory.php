<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Factories;

use FrankVanHest\ValueObjects\Interfaces\IntegerValueModifier;
use FrankVanHest\ValueObjects\Interfaces\IntegerValueObject;

final class IntegerValueObjectFactory
{
    /**
     * @template T of IntegerValueObject
     * @param class-string<T> $class
     * @return T
     */
    public static function create(
        string $class,
        int $value,
        IntegerValueModifier ...$integerValueModifiers,
    ): IntegerValueObject {
        foreach ($integerValueModifiers as $integerValueModifier) {
            $value = $integerValueModifier->modify($value);
        }

        return $class::fromInteger($value);
    }
}
