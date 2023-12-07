<?php

namespace BeerFinder\Controllers;

use BeerFinder\Application\UseCase\Beer\SearchBeerQuery;
use BeerFinder\Domain\Model\Location;
use BeerFinder\Infrastructure\GenericRepository\DatabaseRepository;
use BeerFinder\Infrastructure\GenericRepository\Interfaces\RepositoryInterface;
use Laminas\Hydrator\ClassMethodsHydrator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BeerController
{
    public function __construct(
        protected SearchBeerQuery $searchBeerQuery
    ) {
    }

    public function searchBeer(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $result = $this->searchBeerQuery->handle((object)[ 'id' =>  $request->getAttribute('id') ]);
        $json = json_encode($result);
        if (false === $json) {
            return $response->withStatus(400);
        }
        $response->getBody()->write($json);
        return $response;
    }
}
