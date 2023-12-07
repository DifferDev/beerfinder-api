<?php

namespace BeerFinder\Infrastructure\SpecificRepository;

interface BeerLocationRepositoryInterface
{
    /**
     * @param float $latitude
     * @param float $longitude
     * @return array<object>
     */
    public function findBeerByGeolocation(float $latitude, float $longitude): array;
}