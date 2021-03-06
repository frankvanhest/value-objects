<?php

namespace FrankVanHest\ValueObjects\Tests\Abstracts;

use FrankVanHest\ValueObjects\Interfaces\ValueObject;
use FrankVanHest\ValueObjects\Tests\Dummies\FloatGreaterThanZeroPointOne;
use PHPUnit\Framework\TestCase;
use Throwable;

final class FloatValueObjectTest extends TestCase
{
    public function testEquals(): void
    {
        $value = 1.99;
        self::assertTrue(
            FloatGreaterThanZeroPointOne::fromFloat($value)->equals(FloatGreaterThanZeroPointOne::fromFloat($value))
        );
    }

    public function testEqualsWhenValueObjectIsNotInteger(): void
    {
        $valueObject = new class implements ValueObject {
            public function equals(?ValueObject $valueObject): bool
            {
                return false;
            }
        };
        self::assertFalse(FloatGreaterThanZeroPointOne::fromFloat(1.3)->equals($valueObject));
    }

    public function testEqualsWhenValueObjectIsNull(): void
    {
        self::assertFalse(FloatGreaterThanZeroPointOne::fromFloat(1.6)->equals(null));
    }

    public function testEqualsWhenValueObjectValueIsDifferent(): void
    {
        self::assertFalse(
            FloatGreaterThanZeroPointOne::fromFloat(0.2)->equals(FloatGreaterThanZeroPointOne::fromFloat(1.5))
        );
    }

    public function testFromFloat(): void
    {
        $value = 0.2;
        $expectedValue = 10.2;
        self::assertSame($expectedValue, FloatGreaterThanZeroPointOne::fromFloat($value)->toFloat());
    }

    public function testFromFloatWhenAssertFailed(): void
    {
        $this->expectException(Throwable::class);
        FloatGreaterThanZeroPointOne::fromFloat(0.05);
    }
}
