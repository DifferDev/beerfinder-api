<?php

namespace Integration;

use BeerFinder\Application\UseCase\Location\GetBeersByLocationQuery;
use BeerFinder\Domain\Model\Location;
use BeerFinder\Infrastructure\SpecificRepository\BeerLocationRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(GetBeersByLocationQuery::class)]
class GetBeersByLocationQueryTest extends TestCase
{
    public function testGetBeersByLocationQueryShouldGetBeers()
    {
        $userLocation = new \stdClass();
        $userLocation->longitude = -46.648073805241665;
        $userLocation->latitude = -23.548523479696584;

        $repositoryMock = \Mockery::mock(BeerLocationRepository::class);
        $repositoryMock->shouldReceive('findBeerByGeolocation')
                   ->andReturn([])
        ;

        $getBeersByLocationQuery = new GetBeersByLocationQuery($repositoryMock);
        $locations = $getBeersByLocationQuery->handle($userLocation);

        $this->assertEquals([], $locations);
    }
}