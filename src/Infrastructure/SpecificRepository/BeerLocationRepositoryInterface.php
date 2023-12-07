<?php

namespace BeerFinder\Infrastructure\SpecificRepository;

interface BeerLocationRepositoryInterface
{
    /**
     * @return object[]
     */
    public function getBeersByLocation(float $latitude, float $longitude): array;
}
