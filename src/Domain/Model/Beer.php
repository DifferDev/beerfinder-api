<?php

namespace BeerFinder\Domain\Model;

use BeerFinder\Domain\ValueObject\Id;
use BeerFinder\Domain\ValueObject\IntegerPrice;
use BeerFinder\Infrastructure\GenericRepository\BaseEntity;

class Beer extends BaseEntity
{
    private string $name;
    private string $type;
    private IntegerPrice $price;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getPrice(): string
    {
        return $this->price->getValue();
    }

    public function setPrice(string $price): void
    {
        $this->price = new IntegerPrice($price);
    }
}
