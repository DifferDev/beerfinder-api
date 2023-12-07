<?php

namespace BeerFinder\Infrastructure\SpecificRepository;

use BeerFinder\Domain\Model\Location;

class BeerLocationRepository implements BeerLocationRepositoryInterface
{

    /**
     * @param float $latitude
     * @param float $longitude
     * @return Location[]
     */
    public function findBeerByGeolocation(float $latitude, float $longitude): array
    {
        return [];
    }
}