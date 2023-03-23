<?php

namespace FrankVanHest\ValueObjects\Tests\Abstracts;

use FrankVanHest\ValueObjects\Interfaces\ValueObject;
use FrankVanHest\ValueObjects\Tests\Dummies\NotEmptyString;
use PHPUnit\Framework\TestCase;
use Throwable;

final class StringValueObjectTest extends TestCase
{
    public function testEquals(): void
    {
        $value = 'foo';
        self::assertTrue(NotEmptyString::fromString($value)->equals(NotEmptyString::fromString($value)));
    }

    public function testEqualsWhenValueObjectIsNotString(): void
    {
        $valueObject = new class implements ValueObject {
            public function equals(?ValueObject $valueObject): bool
            {
                return false;
            }
        };
        self::assertFalse(NotEmptyString::fromString('foo')->equals($valueObject));
    }

    public function testEqualsWhenValueObjectIsNull(): void
    {
        self::assertFalse(NotEmptyString::fromString('foo')->equals(null));
    }

    public function testEqualsWhenValueObjectValueIsDifferent(): void
    {
        self::assertFalse(NotEmptyString::fromString('foo')->equals(NotEmptyString::fromString('bar')));
    }

    public function testFromString(): void
    {
        $value = 'foo';
        $expectedValue = 'foo';
        self::assertSame($expectedValue, NotEmptyString::fromString($value)->asString());
    }

    public function testFromStringWhenAssertFailed(): void
    {
        $this->expectException(Throwable::class);
        NotEmptyString::fromString('');
    }
}
