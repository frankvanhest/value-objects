<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use FrankVanHest\ValueObjects\Interfaces\BooleanValueObject as BooleanValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;

abstract readonly class BooleanValueObject implements BooleanValueObjectInterface
{
    use DontUseMagicMethods;

    final protected function __construct(private bool $value)
    {
    }

    final public function asBoolean(): bool
    {
        return $this->value;
    }

    final public function equals(?ValueObject $valueObject): bool
    {
        return $valueObject instanceof static && $valueObject->asBoolean() === $this->value;
    }

    final public static function fromBoolean(bool $value): static
    {
        return new static($value);
    }
}
