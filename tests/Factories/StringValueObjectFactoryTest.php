<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Tests\Factories;

use FrankVanHest\ValueObjects\Factories\StringValueObjectFactory;
use FrankVanHest\ValueObjects\Tests\Dummies\PrefixStringValue;
use FrankVanHest\ValueObjects\Tests\Dummies\NotEmptyString;
use PHPUnit\Framework\TestCase;

final class StringValueObjectFactoryTest extends TestCase
{
    public function testFactoryWithoutValueAlteration(): void
    {
        $valueObject = StringValueObjectFactory::create(NotEmptyString::class, 'not-empty');
        self::assertInstanceOf(
            NotEmptyString::class,
            $valueObject
        );
    }

    public function testFactoryWithValueAlteration(): void
    {
        $valueModifierPrefix = new PrefixStringValue('two-');
        $valueModifierPostfix = new PrefixStringValue('one-');
        $valueObject = StringValueObjectFactory::create(
            NotEmptyString::class,
            'not-empty',
            $valueModifierPrefix,
            $valueModifierPostfix
        );
        self::assertInstanceOf(
            NotEmptyString::class,
            $valueObject
        );
        self::assertSame('one-two-not-empty', $valueObject->asString());
    }
}
