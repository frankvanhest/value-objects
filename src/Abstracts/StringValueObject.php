<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use Dont\JustDont;
use FrankVanHest\ValueObjects\Interfaces\StringValueObject as StringValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;

abstract class StringValueObject implements StringValueObjectInterface
{
    use JustDont;

    final protected function __construct(private readonly string $value)
    {
        $this->assert($this->value);
    }

    final public function equals(?ValueObject $valueObject): bool
    {
        return $valueObject instanceof static && $valueObject->toString() === $this->value;
    }

    final public function toString(): string
    {
        return $this->value;
    }

    final public static function fromString(string $value): static
    {
        return new static($value);
    }

    /**
     * @throws \Throwable When the string value does not match the requirements
     */
    abstract protected function assert(string $value): void;
}
