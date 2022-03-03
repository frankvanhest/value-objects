<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use Dont\JustDont;
use FrankVanHest\ValueObjects\Interfaces\FloatValueObject as FloatValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;

abstract class FloatValueObject implements FloatValueObjectInterface
{
    use JustDont;

    final protected function __construct(private float $value)
    {
        $this->value = $this->alterValueBeforeConstructing($this->value);
        $this->assert($this->value);
    }

    final public function equals(?ValueObject $valueObject): bool
    {
        return $valueObject instanceof static && $valueObject->toFloat() === $this->value;
    }

    final public function toFloat(): float
    {
        return $this->value;
    }

    /**
     * Override this method to modify the value while constructing the class and before asserting the value
     */
    protected function alterValueBeforeConstructing(float $value): float
    {
        return $value;
    }

    final public static function fromFloat(float $value): static
    {
        return new static($value);
    }

    /**
     * @throws \Throwable When the float value does not match the requirements
     */
    abstract protected function assert(float $value): void;
}
