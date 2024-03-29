<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use FrankVanHest\ValueObjects\Interfaces\StringValueObject as StringValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;
use Throwable;

abstract readonly class StringValueObject implements StringValueObjectInterface
{
    use DontUseMagicMethods;

    final protected function __construct(private string $value)
    {
        $this->assert($this->value);
    }

    final public function asString(): string
    {
        return $this->value;
    }

    final public function equals(?ValueObject $valueObject): bool
    {
        return $valueObject instanceof static && $valueObject->asString() === $this->value;
    }

    final public static function fromString(string $value): static
    {
        return new static($value);
    }

    /**
     * @throws Throwable When the string value does not match the requirements
     */
    abstract protected function assert(string $value): void;
}
