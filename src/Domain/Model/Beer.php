<?php

namespace BeerFinder\Domain\Model;

use BeerFinder\Domain\ValueObject\Id;
use BeerFinder\Domain\ValueObject\IntegerPrice;
use BeerFinder\Infrastructure\GenericRepository\BaseEntity;
use Exception;

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

    /**
     * @return void
     * @throws Exception
     */
    public function validate(): void
    {
        $this->checkPrice();
        $this->checkValue('name');
        $this->checkValue('type');
        $this->checkValue('price');
    }

    /**
     * @param string $field
     * @return void
     * @throws Exception
     */
    private function checkValue(string $field): void
    {
        if ('' === $this->$field) {
            throw new Exception("\$$field should be provided");
        }
        if (mb_strlen($this->$field, 'UTF-8') < 2) {
            throw new Exception("\$$field should be more then 1 char");
        }
    }

    private function checkPrice(): void
    {
        if ('000' === $this->price->getValue()) {
            throw new Exception('Price cannot be zero!');
        }
    }
}
