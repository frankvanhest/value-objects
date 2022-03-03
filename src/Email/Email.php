<?php

namespace FrankVanHest\ValueObjects\Email;

use Assert\Assertion;
use FrankVanHest\ValueObjects\Abstracts\StringValueObject;

class Email extends StringValueObject
{
    final public function localPart(): string
    {
        return explode('@', $this->toString())[0];
    }

    final public function domainName(): string
    {
        return explode('@', $this->toString())[1];
    }

    protected function assert(string $string): void
    {
        Assertion::email($string);
    }

    protected function alterValueBeforeConstructing(string $value): string
    {
        return strtolower($value);
    }
}
