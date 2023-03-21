<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Tests\Dummies;

use FrankVanHest\ValueObjects\Interfaces\FloatValueModifier;

final class AddFloatValue implements FloatValueModifier
{
    public function __construct(
        private readonly float $float,
    ) {
    }

    public function modify(float $value): float
    {
        return $this->float + $value;
    }
}
