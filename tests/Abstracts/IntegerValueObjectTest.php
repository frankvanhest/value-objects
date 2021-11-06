<?php

namespace FrankVanHest\ValueObjects\Tests\Abstracts;

use FrankVanHest\ValueObjects\Interfaces\ValueObject;
use FrankVanHest\ValueObjects\Tests\Dummies\IntegerGreaterThanZero;
use PHPUnit\Framework\TestCase;
use Throwable;

final class IntegerValueObjectTest extends TestCase
{
    public function testEquals(): void
    {
        $value = 1;
        self::assertTrue(IntegerGreaterThanZero::fromInteger($value)->equals(IntegerGreaterThanZero::fromInteger($value)));
    }

    public function testEqualsWhenValueObjectIsNotInteger(): void
    {
        $valueObject = new class implements ValueObject {
            public function equals(?ValueObject $valueObject): bool
            {
                return false;
            }
        };
        self::assertFalse(IntegerGreaterThanZero::fromInteger(1)->equals($valueObject));
    }

    public function testEqualsWhenValueObjectIsNull(): void
    {
        self::assertFalse(IntegerGreaterThanZero::fromInteger(1)->equals(null));
    }

    public function testEqualsWhenValueObjectValueIsDifferent(): void
    {
        self::assertFalse(IntegerGreaterThanZero::fromInteger(1)->equals(IntegerGreaterThanZero::fromInteger(2)));
    }

    public function testFromInteger(): void
    {
        $value = 1;
        $expectedValue = 11;
        self::assertSame($expectedValue, IntegerGreaterThanZero::fromInteger($value)->toInteger());
    }

    public function testFromIntegerWhenAssertFailed(): void
    {
        $this->expectException(Throwable::class);
        IntegerGreaterThanZero::fromInteger(0);
    }
}
