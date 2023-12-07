<?php

namespace Unit;

use BeerFinder\Domain\ValueObject\Id;
use BeerFinder\Domain\ValueObject\IntegerPrice;
use Exception;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Id::class)]
class IdTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testValueObjectShouldReceiveAValidValue(): void
    {
        $id = new Id(123);
        $this->assertEquals(123, $id->getValue());
    }

    public function testValueObjectShouldReceiveAValidNumber1Value(): void
    {
        $id = new Id(1);
        $this->assertEquals(1, $id->getValue());
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testValueObjectShouldReceiveAValidUuidValue(): void
    {
        $id = new Id('2be2072a-1a5c-4c8a-a400-8361008d39ea');
        $this->assertEquals('2be2072a-1a5c-4c8a-a400-8361008d39ea', $id);
    }

    public static function idNegativeProvider(): array
    {
        return [
            [-123, \Exception::class, 'Invalid Id number'],
            ['123-123-123', \Exception::class, 'Id should be a valid UUID'],
            ['e2072a-1a5c-4c8a-a400-83610d39ea', \Exception::class, 'Id should be a valid UUID']
        ];
    }

    /**
     * @throws Exception
     */
    #[DataProvider('idNegativeProvider')]
    public function testValueObjectShouldReceiveAInValidNegativeValue(
        int|string $value,
        string $exception,
        string $message
    ): void
    {
        $this->expectException($exception);
        $this->expectExceptionMessage($message);
        $id = new Id($value);
    }
}
