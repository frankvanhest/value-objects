<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Exceptions;

final class DontUseMagicMethodUnset extends \LogicException
{
    public function __construct(string $class)
    {
        parent::__construct(sprintf('Don\t use magic method __unset in class %s', $class));
    }
}
