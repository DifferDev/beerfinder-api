<?php

namespace Integration;

use BeerFinder\Application\UseCase\Location\GetBeersByLocationQuery;
use BeerFinder\Domain\Model\BeerLocation;
use BeerFinder\Infrastructure\SpecificRepository\BeerLocationRepositoryInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(GetBeersByLocationQuery::class)]
class GetBeersByLocationQueryTest extends TestCase
{
    public function testGetBeersByLocationQueryShouldReturnBeerLocations(): void
    {
        $beerLocation1 = new BeerLocation();
        $beerLocation1->setId(3);
        $beerLocation1->setName('Citrus Zest Saison');
        $beerLocation1->setType('Pilsner');
        $beerLocation1->setPrice('1075');
        $beerLocation1->setLatitude(-23.55356562);
        $beerLocation1->setLongitude(-46.64282353);

        $beerLocation2 = new BeerLocation();
        $beerLocation2->setId(6);
        $beerLocation2->setName('Midnight Velvet Porter');
        $beerLocation2->setType('Porter');
        $beerLocation2->setPrice('1150');
        $beerLocation2->setLatitude(-23.54557669);
        $beerLocation2->setLongitude(-46.64010910);


        $mock = \Mockery::mock(BeerLocationRepositoryInterface::class);
        $mock->shouldReceive('getBeersByLocation')
             ->with(-23.548918185855413, -46.633878644471906)
             ->andReturn([
                 $beerLocation1,
                 $beerLocation2
             ]);

        $getBeersByLocationQuery = new GetBeersByLocationQuery($mock);

        $query = new \stdClass();
        $query->latitude = -23.548918185855413;
        $query->longitude = -46.633878644471906;

        $result = $getBeersByLocationQuery->handle($query);

        $beerLocations = $result['results'];

        $this->assertCount(2, $beerLocations);
        $this->assertEquals(
            -23.55356562,
            $beerLocations[0]->getLatitude()
        );
        $this->assertEquals(
            -46.64282353,
            $beerLocations[0]->getLongitude()
        );
    }
}