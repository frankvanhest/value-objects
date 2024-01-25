<?php

namespace FrankVanHest\ValueObjects\Tests\Abstracts;

use FrankVanHest\ValueObjects\Abstracts\FloatValueObject;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodCall;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodCallStatic;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodGet;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodIsset;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodSet;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodUnset;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;
use FrankVanHest\ValueObjects\Tests\Dummies\FloatGreaterThanZeroPointOne;
use PHPUnit\Framework\TestCase;
use Throwable;

final class FloatValueObjectTest extends TestCase
{
    public function testClassIsReadonly(): void
    {
        self::assertTrue((new \ReflectionClass(FloatValueObject::class))->isReadOnly());
    }

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
        $expectedValue = 0.2;
        self::assertSame($expectedValue, FloatGreaterThanZeroPointOne::fromFloat($value)->asFloat());
    }

    public function testFromFloatWhenAssertFailed(): void
    {
        $this->expectException(Throwable::class);
        FloatGreaterThanZeroPointOne::fromFloat(0.05);
    }

    public function testPreventMagicCall(): void
    {
        $object = FloatGreaterThanZeroPointOne::fromFloat(0.2);
        $this->expectException(DontUseMagicMethodCall::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __call in class %s', FloatGreaterThanZeroPointOne::class)
        );
        /** @phpstan-ignore-next-line */
        $object->nonExistingMethod();
    }

    public function testPreventMagicCallStatic(): void
    {
        $object = FloatGreaterThanZeroPointOne::fromFloat(0.2);
        $this->expectException(DontUseMagicMethodCallStatic::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __callStatic in class %s', FloatGreaterThanZeroPointOne::class)
        );
        /** @phpstan-ignore-next-line */
        $object::nonExistingStaticMethod();
    }

    public function testPreventMagicGet(): void
    {
        $object = FloatGreaterThanZeroPointOne::fromFloat(0.2);
        $this->expectException(DontUseMagicMethodGet::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __get in class %s', FloatGreaterThanZeroPointOne::class)
        );
        /** @phpstan-ignore-next-line */
        $object->nonExistingProperty;
    }

    public function testPreventMagicIsset(): void
    {
        $object = FloatGreaterThanZeroPointOne::fromFloat(0.2);
        $this->expectException(DontUseMagicMethodIsset::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __isset in class %s', FloatGreaterThanZeroPointOne::class)
        );
        /** @phpstan-ignore-next-line */
        isset($object->nonExistingProperty);
    }

    public function testPreventMagicSet(): void
    {
        $object = FloatGreaterThanZeroPointOne::fromFloat(0.2);
        $this->expectException(DontUseMagicMethodSet::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __set in class %s', FloatGreaterThanZeroPointOne::class)
        );
        /** @phpstan-ignore-next-line */
        $object->nonExistingProperty = 1;
    }

    public function testPreventMagicUnset(): void
    {
        $object = FloatGreaterThanZeroPointOne::fromFloat(0.2);
        $this->expectException(DontUseMagicMethodUnset::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __unset in class %s', FloatGreaterThanZeroPointOne::class)
        );
        /** @phpstan-ignore-next-line */
        unset($object->nonExistingProperty);
    }

    public function testPreventedMagicMethodsAreFinal(): void
    {
        self::assertTrue((new \ReflectionMethod(FloatValueObject::class, '__call'))->isFinal());
        self::assertTrue((new \ReflectionMethod(FloatValueObject::class, '__callStatic'))->isFinal());
        self::assertTrue((new \ReflectionMethod(FloatValueObject::class, '__get'))->isFinal());
        self::assertTrue((new \ReflectionMethod(FloatValueObject::class, '__isset'))->isFinal());
        self::assertTrue((new \ReflectionMethod(FloatValueObject::class, '__set'))->isFinal());
        self::assertTrue((new \ReflectionMethod(FloatValueObject::class, '__unset'))->isFinal());
    }
}
