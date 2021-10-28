<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use Dont\JustDont;
use FrankVanHest\ValueObjects\Interfaces\BooleanValueObject as BooleanValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;

abstract class BooleanValueObject implements BooleanValueObjectInterface
{
    use JustDont;

    private bool $value;

    final private function __construct()
    {
    }

    final public function equals(?ValueObject $valueObject): bool
    {
        return $valueObject instanceof static && $valueObject->toBoolean() === $this->value;
    }

    final public function toBoolean(): bool
    {
        return $this->value;
    }

    final public static function fromBoolean(bool $value): static
    {
        $instance = new static();
        $instance->value = $value;

        return $instance;
    }
}
