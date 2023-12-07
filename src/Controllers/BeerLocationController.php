<?php

namespace BeerFinder\Controllers;

use BeerFinder\Domain\Model\Location;
use BeerFinder\Infrastructure\GenericRepository\DatabaseRepository;
use BeerFinder\Infrastructure\GenericRepository\Interfaces\RepositoryInterface;
use Laminas\Hydrator\ClassMethodsHydrator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BeerLocationController
{
    public function __construct(
        protected DatabaseRepository $repository,
        protected ClassMethodsHydrator $hydrator
    ) {
    }

    public function getBeerLocations(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $response;
    }
}
