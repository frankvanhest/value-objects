<?php

namespace FrankVanHest\ValueObjects\Email;

use Assert\Assertion;
use FrankVanHest\ValueObjects\Abstracts\StringValueObject;

class Email extends StringValueObject
{
    public function localPart(): string
    {
        return explode('@', $this->toString())[0];
    }

    public function domainName(): string
    {
        return explode('@', $this->toString())[1];
    }

    protected function assert(string $string): void
    {
        Assertion::email($string);
    }

    protected function modifyValue(string $value): string
    {
        return strtolower($value);
    }
}
