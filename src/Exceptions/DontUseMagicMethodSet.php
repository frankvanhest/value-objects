<?php

declare(strict_types=1);

namespace FrankVanHest\ValueObjects\Exceptions;

final class DontUseMagicMethodSet extends \LogicException
{
    public function __construct(string $class)
    {
        parent::__construct(sprintf('Don\t use magic method __set in class %s', $class));
    }
}
