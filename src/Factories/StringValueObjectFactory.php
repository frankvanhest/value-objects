<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Factories;

use FrankVanHest\ValueObjects\Interfaces\StringValueModifier;
use FrankVanHest\ValueObjects\Interfaces\StringValueObject;

final class StringValueObjectFactory
{
    /**
     * @template T of StringValueObject
     * @param class-string<T> $class
     * @return T
     */
    public static function create(
        string $class,
        string $value,
        StringValueModifier ...$stringValueModifiers,
    ): StringValueObject {
        foreach ($stringValueModifiers as $stringValueModifier) {
            $value = $stringValueModifier->modify($value);
        }

        return $class::fromString($value);
    }
}
