<?php

namespace FrankVanHest\ValueObjects\Tests\Abstracts;

use FrankVanHest\ValueObjects\Interfaces\ValueObject;
use FrankVanHest\ValueObjects\Tests\Dummies\AreWeGreat;
use PHPUnit\Framework\TestCase;

final class BooleanValueObjectTest extends TestCase
{
    public function testEquals(): void
    {
        $value = true;
        self::assertTrue(AreWeGreat::fromBoolean($value)->equals(AreWeGreat::fromBoolean($value)));
    }

    public function testEqualsWhenValueObjectIsNotInteger(): void
    {
        $valueObject = new class implements ValueObject {
            public function equals(?ValueObject $valueObject): bool
            {
                return false;
            }
        };
        self::assertFalse(AreWeGreat::fromBoolean(true)->equals($valueObject));
    }

    public function testEqualsWhenValueObjectIsNull(): void
    {
        self::assertFalse(AreWeGreat::fromBoolean(true)->equals(null));
    }

    public function testEqualsWhenValueObjectValueIsDifferent(): void
    {
        self::assertFalse(AreWeGreat::fromBoolean(true)->equals(AreWeGreat::fromBoolean(false)));
    }

    public function testFromBoolean(): void
    {
        $value = true;
        self::assertSame($value, AreWeGreat::fromBoolean($value)->asBoolean());
    }
}
