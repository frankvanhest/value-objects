<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Abstracts;

use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodCall;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodCallStatic;

trait DontUseMagicMethods
{
    /**
     * @param array<mixed> $arguments
     */
    final public function __call(string $name, array $arguments): void
    {
        throw new DontUseMagicMethodCall(static::class);
    }

    /**
     * @param array<mixed> $arguments
     */
    final public static function __callStatic(string $name, array $arguments): void
    {
        throw new DontUseMagicMethodCallStatic(static::class);
    }
}
