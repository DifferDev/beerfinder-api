<?php

namespace BeerFinder\Domain\ValueObject\Interface;

use Stringable;

interface ValueObjectInterface extends Stringable
{
    public function getValue(): mixed;
}
