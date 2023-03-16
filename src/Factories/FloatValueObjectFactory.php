<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Factories;

use FrankVanHest\ValueObjects\Interfaces\FloatValueModifier;
use FrankVanHest\ValueObjects\Interfaces\FloatValueObject;

final class FloatValueObjectFactory
{
    /**
     * @template T of FloatValueObject
     * @param class-string<T> $class
     * @return T
     */
    public static function create(
        string $class,
        float $value,
        FloatValueModifier ...$floatValueModifiers,
    ): FloatValueObject {
        foreach ($floatValueModifiers as $floatValueModifier) {
            $value = $floatValueModifier->modify($value);
        }

        return $class::fromFloat($value);
    }
}
