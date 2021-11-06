<?php

namespace FrankVanHest\ValueObjects\Tests\Email;

use Assert\AssertionFailedException;
use FrankVanHest\ValueObjects\Email\Email;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    /**
     * @return array<array<string>>
     */
    public function correctValues(): array
    {
        return [
            ['user@domain.com', 'user@domain.com'],
            ['User@domain.com', 'user@domain.com'],
            ['user.123@domain.com', 'user.123@domain.com'],
            ['USER.123@domain.com', 'user.123@domain.com'],
            ['user+mailbox@domain.com', 'user+mailbox@domain.com'],
            ['user+mailbox/department=shipping@domain.com', 'user+mailbox/department=shipping@domain.com'],
            ["!#$%&'*+-/=?^_`.{|}~@example.com", "!#$%&'*+-/=?^_`.{|}~@example.com"]
        ];
    }

    /**
     * @return array<array<string>>
     */
    public function incorrectValues(): array
    {
        return [
            ['John..Doe@example.com'],
            ['John Doe@example.com'],
            ['"John Doe"@example.com'],
        ];
    }

    /**
     * @dataProvider correctValues
     */
    public function testFromString(string $value, string $expectedValue): void
    {
        self::assertSame($expectedValue, Email::fromString($value)->toString());
    }

    /**
     * @dataProvider incorrectValues
     */
    public function testFromStringWithInvalidValue(string $value): void
    {
        $this->expectException(AssertionFailedException::class);
        Email::fromString($value);
    }
}
