<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Tests\Factories;

use FrankVanHest\ValueObjects\Factories\FloatValueObjectFactory;
use FrankVanHest\ValueObjects\Tests\Dummies\AddFloatValue;
use FrankVanHest\ValueObjects\Tests\Dummies\FloatGreaterThanZeroPointOne;
use PHPUnit\Framework\TestCase;

final class FloatValueObjectFactoryTest extends TestCase
{
    public function testFactoryWithValueAlteration(): void
    {
        $valueModifierFirst = new AddFloatValue(0.2);
        $valueModifierSecond = new AddFloatValue(0.3);
        $valueObject = FloatValueObjectFactory::create(
            FloatGreaterThanZeroPointOne::class,
            0.2,
            $valueModifierFirst,
            $valueModifierSecond
        );
        self::assertInstanceOf(
            FloatGreaterThanZeroPointOne::class,
            $valueObject
        );
        self::assertSame(0.7, $valueObject->asFloat());
    }

    public function testFactoryWithoutValueAlteration(): void
    {
        $valueObject = FloatValueObjectFactory::create(FloatGreaterThanZeroPointOne::class, 0.2);
        self::assertInstanceOf(
            FloatGreaterThanZeroPointOne::class,
            $valueObject
        );
    }
}
