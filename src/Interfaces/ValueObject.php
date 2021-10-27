<?php

namespace FrankVanHest\ValueObjects\Interfaces;

interface ValueObject
{
    public function equals(?ValueObject $valueObject): bool;
}
