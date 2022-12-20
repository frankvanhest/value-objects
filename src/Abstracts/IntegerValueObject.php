<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use Dont\JustDont;
use FrankVanHest\ValueObjects\Interfaces\IntegerValueObject as IntegerValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;

abstract readonly class IntegerValueObject implements IntegerValueObjectInterface
{
    use JustDont;

    private int $value;

    final private function __construct(int $value)
    {
        $this->value = $this->alterValueBeforeConstructing($value);
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
     * Override this method to alter the value before constructing the instance
     */
    protected function alterValueBeforeConstructing(int $value): int
    {
        return $value;
    }

    /**
     * @throws \Throwable When the integer value does not match the requirements
     */
    abstract protected function assert(int $value): void;
}
