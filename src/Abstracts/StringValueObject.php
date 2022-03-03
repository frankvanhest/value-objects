<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use Dont\JustDont;
use FrankVanHest\ValueObjects\Interfaces\StringValueObject as StringValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;

abstract class StringValueObject implements StringValueObjectInterface
{
    use JustDont;

    final protected function __construct(private string $value)
    {
        $this->value = $this->alterValueBeforeConstructing($this->value);
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

    /**
     * Override this method to alter the value before constructing the instance
     */
    protected function alterValueBeforeConstructing(string $value): string
    {
        return $value;
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
