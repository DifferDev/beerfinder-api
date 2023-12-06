<?php

namespace Unit\ValueObjects;

use BeerFinder\Domain\ValueObject\IntegerPrice;
use Exception;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(IntegerPrice::class)]
class IntegerPriceTest extends TestCase
{
    /**
     * @return void
     * @throws Exception
     */
    public function testPriceShouldBeAValidIntegerValue(): void
    {
        $price = new IntegerPrice('1233');
        $this->assertEquals('1233', $price->getValue());
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testPriceShouldBeAValidFloatValue(): void
    {
        $price = new IntegerPrice('0.23');
        $this->assertEquals('023', $price->getValue());
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testPriceShouldBeAValidCommaFloatValue(): void
    {
        $price = new IntegerPrice('20,23');
        $this->assertEquals('2023', (string)$price);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testPriceShouldBeAInvalidIntegerValue(): void
    {
        $this->expectExceptionMessage('Price should be in right format ex: 0.22 or 022, provided: 01');
        $price = new IntegerPrice('0.1');
    }
}