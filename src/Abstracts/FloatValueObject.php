<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use Dont\JustDont;
use FrankVanHest\ValueObjects\Interfaces\FloatValueObject as FloatValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;

abstract class FloatValueObject implements FloatValueObjectInterface
{
    use JustDont;

    protected float $value;

    final private function __construct()
    {
    }

    final public function equals(?ValueObject $valueObject): bool
    {
        return $valueObject instanceof static && $valueObject->toFloat() === $this->value;
    }

    final public function toFloat(): float
    {
        return $this->value;
    }

    final public static function fromFloat(float $value): static
    {
        static::assert($value);
        $instance = new static();
        $instance->value = $value;

        return $instance;
    }

    /**
     * @throws \Throwable When the float value does not match the requirements
     */
    abstract protected static function assert(float $float): void;
}
