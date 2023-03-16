<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Interfaces;

interface FloatValueModifier
{
    public function modify(float $value): float;
}
