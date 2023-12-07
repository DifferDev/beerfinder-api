<?php

namespace BeerFinder\Controller;

use BeerFinder\Application\UseCase\Beer\SearchBeerQuery;
use BeerFinder\Application\UseCase\Interfaces\QueryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BeerController
{
    public function __construct(
        protected SearchBeerQuery $query
    ) {
    }

    public function get(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $id = $request->getAttribute('id');

        $query = new \stdClass();
        $query->id = $id;

        /** @phpstan-ignore-next-line */
        $beer = $this->query->handle($query);

        $response->getBody()->write(
            json_encode($beer)
        );

        return $response;
    }
}