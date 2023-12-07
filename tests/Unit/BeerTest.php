<?php

namespace Unit;

use BeerFinder\Domain\Model\Beer;
use BeerFinder\Domain\ValueObject\IntegerPrice;
use Exception;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Beer::class)]
#[UsesClass(IntegerPrice::class)]
class BeerTest extends TestCase
{
    public function testBeerDomainShouldValidate(): void
    {
        $beer = new Beer();
        $beer->setName('Beer 1');
        $beer->setType('IPA');
        $beer->setPrice('1233');

        $beer->validate();

        $this->assertEquals('Beer 1', $beer->getName());
        $this->assertEquals('IPA', $beer->getType());
        $this->assertEquals('1233', $beer->getPrice());
    }

    public static function negativeBeerProvider(): array
    {
        return [
            ['Beer 2', '', '344', '$type should be provided'],
            ['Beer 3', 'N', '344', '$type should be more then 1 char'],
            ['Beer 4', 'Pilsen', '', 'Price should be in right format ex: 0.22 or 022, provided:'],
            ['', 'ABC', '344', '$name should be provided'],
            ['ABC', '', '344', '$type should be provided'],
            ['ABC', 'ABC', '', 'Price should be in right format ex: 0.22 or 022, provided: '],
            ['A', '', '344', '$name should be more then 1 char'],
            ['', '', '', 'Price should be in right format ex: 0.22 or 022, provided:'],
            ['Beer 3', 'N', '100', '$type should be more then 1 char'],
            ['AA', 'S', '100', '$type should be more then 1 char'],
            ['Á', 'A', '200', '$name should be more then 1 char'],
            ['Beer Bock', 'Bock', '000', 'Price should not be zero']
        ];
    }

    #[DataProvider('negativeBeerProvider')]
    public function testBeerShouldThrowException(
        string $name,
        string $type,
        string $price,
        string $message
    ): void
    {
        $this->expectExceptionMessage($message);

        $beer = new Beer();
        $beer->setName($name);
        $beer->setType($type);
        $beer->setPrice($price);

        $beer->validate();
    }
}