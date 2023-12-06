<?php

namespace BeerFinder\Infrastructure\GenericRepository;

use BeerFinder\Domain\ValueObject\Id;

class BaseEntity
{
    public Id|null $id = null;
}
