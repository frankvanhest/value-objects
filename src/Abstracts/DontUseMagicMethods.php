<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Abstracts;

use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodCall;

trait DontUseMagicMethods
{
    /**
     * @param array<mixed> $arguments
     */
    final public function __call(string $name, array $arguments): void
    {
        throw new DontUseMagicMethodCall(static::class);
    }
}
