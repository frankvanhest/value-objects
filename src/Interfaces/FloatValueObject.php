<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Interfaces;

interface FloatValueObject extends ValueObject
{
    public function toFloat(): int;

    public static function fromFloat(int $value): static;
}
