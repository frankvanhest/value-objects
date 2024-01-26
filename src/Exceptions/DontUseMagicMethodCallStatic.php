<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Exceptions;

use LogicException;

final class DontUseMagicMethodCallStatic extends LogicException
{
    /**
     * @param class-string $class
     */
    public function __construct(string $class)
    {
        parent::__construct(sprintf('Don\t use magic method __callStatic in class %s', $class));
    }
}
