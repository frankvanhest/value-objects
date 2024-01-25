<?php

namespace FrankVanHest\ValueObjects\Tests\Abstracts;

use FrankVanHest\ValueObjects\Abstracts\StringValueObject;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodCall;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodCallStatic;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodGet;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;
use FrankVanHest\ValueObjects\Tests\Dummies\NotEmptyString;
use PHPUnit\Framework\TestCase;
use Throwable;

final class StringValueObjectTest extends TestCase
{
    public function testClassIsReadonly(): void
    {
        self::assertTrue((new \ReflectionClass(StringValueObject::class))->isReadOnly());
    }

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

    public function testPreventMagicCall(): void
    {
        $foo = NotEmptyString::fromString('foo');
        $this->expectException(DontUseMagicMethodCall::class);
        $this->expectExceptionMessage(sprintf('Don\t use magic method __call in class %s', NotEmptyString::class));
        /** @phpstan-ignore-next-line */
        $foo->nonExistingMethod();
    }

    public function testPreventMagicCallStatic(): void
    {
        $foo = NotEmptyString::fromString('foo');
        $this->expectException(DontUseMagicMethodCallStatic::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __callStatic in class %s', NotEmptyString::class)
        );
        /** @phpstan-ignore-next-line */
        $foo::nonExistingStaticMethod();
    }

    public function testPreventMagicGet(): void
    {
        $foo = NotEmptyString::fromString('foo');
        $this->expectException(DontUseMagicMethodGet::class);
        $this->expectExceptionMessage(
            sprintf('Don\t use magic method __get in class %s', NotEmptyString::class)
        );
        /** @phpstan-ignore-next-line */
        $foo->nonExistingProperty;
    }
}
