<?php

namespace FrankVanHest\ValueObjects\Tests\Abstracts;

use FrankVanHest\ValueObjects\Abstracts\BooleanValueObject;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodCall;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodCallStatic;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodGet;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodSet;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;
use FrankVanHest\ValueObjects\Tests\Dummies\AreWeGreat;
use PHPUnit\Framework\TestCase;

final class BooleanValueObjectTest extends TestCase
{
    public function testClassIsReadonly(): void
    {
        self::assertTrue((new \ReflectionClass(BooleanValueObject::class))->isReadOnly());
    }

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

    public function testPreventMagicCall(): void
    {
        $object = AreWeGreat::fromBoolean(true);
        $this->expectException(DontUseMagicMethodCall::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __call in class %s', AreWeGreat::class)
        );
        /** @phpstan-ignore-next-line */
        $object->nonExistingMethod();
    }

    public function testPreventMagicCallStatic(): void
    {
        $object = AreWeGreat::fromBoolean(true);
        $this->expectException(DontUseMagicMethodCallStatic::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __callStatic in class %s', AreWeGreat::class)
        );
        /** @phpstan-ignore-next-line */
        $object::nonExistingStaticMethod();
    }

    public function testPreventMagicGet(): void
    {
        $object = AreWeGreat::fromBoolean(true);
        $this->expectException(DontUseMagicMethodGet::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __get in class %s', AreWeGreat::class)
        );
        /** @phpstan-ignore-next-line */
        $object->nonExistingProperty;
    }

    public function testPreventMagicSet(): void
    {
        $object = AreWeGreat::fromBoolean(true);
        $this->expectException(DontUseMagicMethodSet::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __set in class %s', AreWeGreat::class)
        );
        /** @phpstan-ignore-next-line */
        $object->nonExistingProperty = 1;
    }
}
