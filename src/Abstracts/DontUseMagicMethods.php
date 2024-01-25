<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Abstracts;

use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodCall;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodCallStatic;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodGet;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodIsset;
use FrankVanHest\ValueObjects\Exceptions\DontUseMagicMethodSet;

trait DontUseMagicMethods
{
    /**
     * @param array<mixed> $arguments
     */
    final public function __call(string $name, array $arguments): void
    {
        throw new DontUseMagicMethodCall(static::class);
    }

    final public function __get(string $name): void
    {
        throw new DontUseMagicMethodGet(static::class);
    }

    final public function __isset(string $name): bool
    {
        throw new DontUseMagicMethodIsset(static::class);
    }

    public function __set(string $name, $value): void
    {
        throw new DontUseMagicMethodSet(static::class);
    }

    /**
     * @param array<mixed> $arguments
     */
    final public static function __callStatic(string $name, array $arguments): void
    {
        throw new DontUseMagicMethodCallStatic(static::class);
    }
}
