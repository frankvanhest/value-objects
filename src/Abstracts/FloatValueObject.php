<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use FrankVanHest\ValueObjects\Interfaces\FloatValueObject as FloatValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;
use Throwable;

abstract readonly class FloatValueObject implements FloatValueObjectInterface
{
    use DontUseMagicMethods;

    final protected function __construct(private float $value)
    {
        $this->assert($this->value);
    }

    final public function asFloat(): float
    {
        return $this->value;
    }

    final public function equals(?ValueObject $valueObject): bool
    {
        return $valueObject instanceof static && $valueObject->asFloat() === $this->value;
    }

    final public static function fromFloat(float $value): static
    {
        return new static($value);
    }

    /**
     * @throws Throwable When the float value does not match the requirements
     */
    abstract protected function assert(float $value): void;
}
