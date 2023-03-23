<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Interfaces;

interface StringValueObject extends ValueObject
{
    public function asString(): string;

    public static function fromString(string $value): static;
}
