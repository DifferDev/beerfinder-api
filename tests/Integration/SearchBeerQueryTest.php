<?php

namespace Integration;

use BeerFinder\Application\UseCase\Beer\SearchBeerQuery;
use BeerFinder\Domain\Model\Beer;
use BeerFinder\Infrastructure\GenericRepository\Interfaces\RepositoryInterface;
use Laminas\Hydrator\ClassMethodsHydrator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(SearchBeerQuery::class)]
class SearchBeerQueryTest extends TestCase
{
    public function testSearchBeerQueryShouldReturnABeer(): void
    {
        $beer = new Beer();
        $beer->setName('My beer');
        $beer->setType('IPA');
        $beer->setId(12);
        $beer->setPrice('1233');

        // Stub uma classe falsa
        $stub = \Mockery::mock(RepositoryInterface::class);
        $stub->shouldReceive('findById')
             ->with(12)
             ->andReturn($beer);

        $stub->shouldReceive('setCollection')
            ->with('beers');

        $stub->shouldReceive('setMapClassName');

        $stubHydrator = \Mockery::mock(ClassMethodsHydrator::class);
        $stubHydrator->shouldReceive('extract')
                     ->andReturn([
                         'id' => '12',
                         'name' => 'My beer',
                         'type' => 'IPA',
                         'price' => '1233'
                     ]);

        $query = new \stdClass();
        $query->id = 12;

        $searchBeerQuery = new SearchBeerQuery($stub, $stubHydrator);
        $result = $searchBeerQuery->handle($query);

        /**
         * @var Beer $beerResult
         */
        $beerResult = $result['result'];

        $this->assertEquals(12, $beerResult['id']);
    }
}