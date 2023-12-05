<?php

declare(strict_types=1);

namespace BeerFinder\Domain\ValueObject;

use BeerFinder\Domain\ValueObject\Interface\ValueObjectInterface;
use Exception;

class IntegerPrice implements ValueObjectInterface
{
    protected string $value;

    /**
     * @param string $value
     * @throws Exception
     */
    public function __construct(string $value)
    {
        $price = str_replace([',', '.'], '', $value);
        $this->validate($price);
        $this->value = $price;
    }

    /**
     * @param string $value
     * @return void
     * @throws Exception
     */
    protected function validate(string $value): void
    {
        if (mb_strlen($value, 'UTF-8') < 3) {
            throw new Exception("Price should be in right format ex: 0.22 or 022, provided: $value");
        }
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
