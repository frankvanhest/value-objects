<?php

namespace FrankVanHest\ValueObjects\Interfaces;

interface BooleanValueObject extends ValueObject
{
    public function asBoolean(): bool;

    public static function fromBoolean(bool $value): static;
}
