<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use Dont\JustDont;
use FrankVanHest\ValueObjects\Interfaces\IntegerValueObject as IntegerValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;

abstract class IntegerValueObject implements IntegerValueObjectInterface
{
    use JustDont;

    private int $value;

    final private function __construct()
    {
    }

    final public function equals(?ValueObject $valueObject): bool
    {
        return $valueObject instanceof static && $valueObject->toInteger() === $this->value;
    }

    final public function toInteger(): int
    {
        return $this->value;
    }

    final public static function fromInteger(int $value): static
    {
        static::assert($value);
        $instance = new static();
        $instance->value = $value;

        return $instance;
    }

    /**
     * @throws \Throwable When the integer value does not match the requirements
     */
    abstract protected static function assert(int $integer): void;
}
