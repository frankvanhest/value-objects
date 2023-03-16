<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Interfaces;

interface IntegerValueModifier
{
    public function modify(int $value): int;
}
