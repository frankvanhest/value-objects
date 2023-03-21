<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Tests\Factories;

use FrankVanHest\ValueObjects\Factories\IntegerValueObjectFactory;
use FrankVanHest\ValueObjects\Tests\Dummies\IntegerGreaterThanZero;
use FrankVanHest\ValueObjects\Tests\Dummies\MultiplyIntegerValue;
use PHPUnit\Framework\TestCase;

final class IntegerValueObjectFactoryTest extends TestCase
{
    public function testFactoryWithoutValueAlteration(): void
    {
        $valueObject = IntegerValueObjectFactory::create(IntegerGreaterThanZero::class, 2);
        self::assertInstanceOf(
            IntegerGreaterThanZero::class,
            $valueObject
        );
    }

    public function testFactoryWithValueAlteration(): void
    {
        $valueModifierFirst = new MultiplyIntegerValue(2);
        $valueModifierSecond = new MultiplyIntegerValue(2);
        $valueObject = IntegerValueObjectFactory::create(
            IntegerGreaterThanZero::class,
            2,
            $valueModifierFirst,
            $valueModifierSecond
        );
        self::assertInstanceOf(
            IntegerGreaterThanZero::class,
            $valueObject
        );
        self::assertSame(8, $valueObject->toInteger());
    }
}
