<?php

namespace BeerFinder\Application\UseCase\Location;

use BeerFinder\Application\UseCase\Interfaces\QueryInterface;
use BeerFinder\Infrastructure\SpecificRepository\BeerLocationRepository;

class GetBeersByLocationQuery implements QueryInterface
{
    public function __construct(
        protected BeerLocationRepository $repository
    ) {
    }

    /**
     * @param object{latitude: float, longitude: float} $query
     * @return array|object[]
     */
    public function handle(object $query): array
    {
        return $this->repository->findBeerByGeolocation($query->latitude, $query->longitude);
    }
}
