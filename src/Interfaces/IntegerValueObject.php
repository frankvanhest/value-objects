<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Interfaces;

interface IntegerValueObject extends ValueObject
{
    public function asInteger(): int;

    public static function fromInteger(int $value): static;
}
