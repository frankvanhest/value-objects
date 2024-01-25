<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use FrankVanHest\ValueObjects\Interfaces\IntegerValueObject as IntegerValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;

abstract readonly class IntegerValueObject implements IntegerValueObjectInterface
{
    final private function __construct(private int $value)
    {
        $this->assert($this->value);
    }

    final public function equals(?ValueObject $valueObject): bool
    {
        return $valueObject instanceof static && $valueObject->asInteger() === $this->value;
    }

    final public function asInteger(): int
    {
        return $this->value;
    }

    final public static function fromInteger(int $value): static
    {
        return new static($value);
    }

    /**
     * @throws \Throwable When the integer value does not match the requirements
     */
    abstract protected function assert(int $value): void;
}
