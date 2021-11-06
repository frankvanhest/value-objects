<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use Dont\JustDont;
use FrankVanHest\ValueObjects\Interfaces\IntegerValueObject as IntegerValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;

abstract class IntegerValueObject implements IntegerValueObjectInterface
{
    use JustDont;

    final private function __construct(private int $value)
    {
        $this->value = $this->modifyValue($this->value);
        $this->assert($this->value);
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
        return new static($value);
    }

    /**
     * Override this method to modify the value while constructing the class and before asserting the value
     */
    protected function modifyValue(int $value): int
    {
        return $value;
    }

    /**
     * @throws \Throwable When the integer value does not match the requirements
     */
    abstract protected function assert(int $value): void;
}
