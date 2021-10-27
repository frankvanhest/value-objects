<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use Dont\JustDont;
use FrankVanHest\ValueObjects\Interfaces\StringValueObject as StringValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;

abstract class StringValueObject implements StringValueObjectInterface
{
    use JustDont;

    private string $value;

    final private function __construct()
    {
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
        static::assert($value);
        $instance = new static();
        $instance->value = $value;

        return $instance;
    }

    /**
     * @throws \Throwable When the string value does not match the requirements
     */
    abstract protected static function assert(string $string): void;
}
