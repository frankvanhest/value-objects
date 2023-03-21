<?php

namespace FrankVanHest\ValueObjects\Abstracts;

use Dont\JustDont;
use FrankVanHest\ValueObjects\Interfaces\BooleanValueObject as BooleanValueObjectInterface;
use FrankVanHest\ValueObjects\Interfaces\ValueObject;

abstract readonly class BooleanValueObject implements BooleanValueObjectInterface
{
    use JustDont;

    final protected function __construct(private bool $value)
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
        return new static($value);
    }
}
