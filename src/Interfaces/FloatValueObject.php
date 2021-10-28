<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Interfaces;

interface FloatValueObject extends ValueObject
{
    public function toFloat(): float;

    public static function fromFloat(float $value): static;
}
