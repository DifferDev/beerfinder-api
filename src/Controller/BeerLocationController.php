<?php

namespace BeerFinder\Controller;

use BeerFinder\Application\UseCase\Beer\SearchBeerQuery;
use BeerFinder\Application\UseCase\Interfaces\QueryInterface;
use BeerFinder\Application\UseCase\Location\GetBeersByLocationQuery;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BeerLocationController
{
    public function __construct(
        protected GetBeersByLocationQuery $query
    ) {
    }

    public function get(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $latitude = $request->getAttribute('latitude');
        $longitude = $request->getAttribute('longitude');

        $query = new \stdClass();
        $query->latitude = $request->getAttribute('latitude');
        $query->longitude = $request->getAttribute('longitude');

        /** @phpstan-ignore-next-line */
        $beer = $this->query->handle($query);

        $response->getBody()->write(
            json_encode($beer, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT)
        );

        return $response;
    }
}
