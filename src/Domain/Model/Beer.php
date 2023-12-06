<?php

namespace BeerFinder\Domain\Model;

use BeerFinder\Domain\ValueObject\Id;
use BeerFinder\Domain\ValueObject\IntegerPrice;
use BeerFinder\Infrastructure\GenericRepository\BaseEntity;

class Beer extends BaseEntity
{
    public string $name;

    public string $brand;

    public string $type;

    public IntegerPrice $price;
}
