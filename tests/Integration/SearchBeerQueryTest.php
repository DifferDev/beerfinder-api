<?php

namespace Integration;

use BeerFinder\Application\UseCase\Beer\SearchBeerQuery;
use BeerFinder\Domain\Model\Beer;
use BeerFinder\Infrastructure\GenericRepository\Interfaces\RepositoryInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(SearchBeerQuery::class)]
class SearchBeerQueryTest extends TestCase
{
    protected RepositoryInterface $repository;

    protected Beer $expectedEntity;

    public function setUp(): void
    {
        $this->expectedEntity = new Beer();
        $this->expectedEntity->setId(1);
        $this->expectedEntity->setName('Americana Beer');
        $this->expectedEntity->setType('IPA');
        $this->expectedEntity->setPrice('2333');

        $this->repository = \Mockery::mock(RepositoryInterface::class);
        $this->repository->shouldReceive('findById')
            ->with(1)
            ->andReturn($this->expectedEntity);
    }

    public function testSearchBeerQueryShouldReturnABeer(): void
    {
        $searchBeerQuery = new SearchBeerQuery($this->repository);
        $result = $searchBeerQuery->handle((object)['id' => 1]);

        $this->assertEquals([
            'result' => $this->expectedEntity
        ], $result);
    }

    public function testSearchBeerQueryShouldReturnException(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Id not provided');

        $searchBeerQuery = new SearchBeerQuery($this->repository);
        $searchBeerQuery->handle(new \stdClass());
    }
}