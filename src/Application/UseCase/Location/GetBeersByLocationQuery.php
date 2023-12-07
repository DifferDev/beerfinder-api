<?php

namespace BeerFinder\Application\UseCase\Location;

use BeerFinder\Application\UseCase\Interfaces\QueryInterface;
use BeerFinder\Infrastructure\GenericRepository\Interfaces\RepositoryInterface;
use BeerFinder\Infrastructure\SpecificRepository\BeerLocationRepositoryInterface;

class GetBeersByLocationQuery implements QueryInterface
{
    public function __construct(
        protected BeerLocationRepositoryInterface $repository
    ) {
    }

    /**
     * @param object{latitude: float, longitude: float} $query
     * @return array<string, array<object>|array<string, mixed>>
     */
    public function handle(object $query): array
    {
        $results = $this->repository->getBeersByLocation(
            $query->latitude,
            $query->longitude
        );

        return [
            'results' => $results
        ];
    }
}
