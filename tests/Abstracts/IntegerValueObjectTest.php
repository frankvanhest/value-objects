<?php

namespace FrankVanHest\ValueObjects\Tests\Abstracts;

use FrankVanHest\ValueObjects\Abstracts\IntegerValueObject;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodCall;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodCallStatic;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodGet;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodIsset;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodSet;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodUnset;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;
use FrankVanHest\ValueObjects\Tests\Dummies\IntegerGreaterThanZero;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use Throwable;

final class IntegerValueObjectTest extends TestCase
{
    public function testClassIsReadonly(): void
    {
        self::assertTrue((new ReflectionClass(IntegerValueObject::class))->isReadOnly());
    }

    public function testEquals(): void
    {
        $value = 1;
        self::assertTrue(
            IntegerGreaterThanZero::fromInteger($value)->equals(IntegerGreaterThanZero::fromInteger($value))
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
        $expectedValue = 1;
        self::assertSame($expectedValue, IntegerGreaterThanZero::fromInteger($value)->asInteger());
    }

    public function testFromIntegerWhenAssertFailed(): void
    {
        $this->expectException(Throwable::class);
        IntegerGreaterThanZero::fromInteger(0);
    }

    public function testPreventMagicCall(): void
    {
        $object = IntegerGreaterThanZero::fromInteger(1);
        $this->expectException(DontUseMagicMethodCall::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __call in class %s', IntegerGreaterThanZero::class)
        );
        /** @phpstan-ignore-next-line */
        $object->nonExistingMethod();
    }

    public function testPreventMagicCallStatic(): void
    {
        $object = IntegerGreaterThanZero::fromInteger(1);
        $this->expectException(DontUseMagicMethodCallStatic::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __callStatic in class %s', IntegerGreaterThanZero::class)
        );
        /** @phpstan-ignore-next-line */
        $object::nonExistingStaticMethod();
    }

    public function testPreventMagicGet(): void
    {
        $object = IntegerGreaterThanZero::fromInteger(1);
        $this->expectException(DontUseMagicMethodGet::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __get in class %s', IntegerGreaterThanZero::class)
        );
        /** @phpstan-ignore-next-line */
        $object->nonExistingProperty;
    }

    public function testPreventMagicIsset(): void
    {
        $object = IntegerGreaterThanZero::fromInteger(1);
        $this->expectException(DontUseMagicMethodIsset::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __isset in class %s', IntegerGreaterThanZero::class)
        );
        /** @phpstan-ignore-next-line */
        isset($object->nonExistingProperty);
    }

    public function testPreventMagicSet(): void
    {
        $object = IntegerGreaterThanZero::fromInteger(1);
        $this->expectException(DontUseMagicMethodSet::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __set in class %s', IntegerGreaterThanZero::class)
        );
        /** @phpstan-ignore-next-line */
        $object->nonExistingProperty = 1;
    }

    public function testPreventMagicUnset(): void
    {
        $object = IntegerGreaterThanZero::fromInteger(1);
        $this->expectException(DontUseMagicMethodUnset::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __unset in class %s', IntegerGreaterThanZero::class)
        );
        /** @phpstan-ignore-next-line */
        unset($object->nonExistingProperty);
    }

    public function testPreventedMagicMethodsAreFinal(): void
    {
        self::assertTrue((new ReflectionMethod(IntegerValueObject::class, '__call'))->isFinal());
        self::assertTrue((new ReflectionMethod(IntegerValueObject::class, '__callStatic'))->isFinal());
        self::assertTrue((new ReflectionMethod(IntegerValueObject::class, '__get'))->isFinal());
        self::assertTrue((new ReflectionMethod(IntegerValueObject::class, '__isset'))->isFinal());
        self::assertTrue((new ReflectionMethod(IntegerValueObject::class, '__set'))->isFinal());
        self::assertTrue((new ReflectionMethod(IntegerValueObject::class, '__unset'))->isFinal());
    }
}
