<?php

namespace BeerFinder\Domain\Model;

use BeerFinder\Domain\ValueObject\Id;
use BeerFinder\Domain\ValueObject\IntegerPrice;

class Beer
{
    public Id $id;

    public string $name;
    public string $brand;

    public string $type;
    public IntegerPrice $price;
}
