<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Interfaces;

interface StringValueModifier
{
    public function modify(string $value): string;
}
