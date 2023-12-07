<?php

namespace BeerFinder\Application\UseCase\Beer;

use BeerFinder\Application\UseCase\Interfaces\QueryInterface;
use BeerFinder\Infrastructure\GenericRepository\Interfaces\RepositoryInterface;

class SearchBeerQuery implements QueryInterface
{
    public function __construct(
        protected RepositoryInterface $repository
    ) {
    }

    /**
     * @param object{id: int|string} $query
     * @return array|object[]
     */
    public function handle(object $query): array
    {
        if (false === isset($query->id)) {
            throw new \Exception('Id not provided');
        }

        $entity = $this->repository->findById($query->id);

        return [
            'result' => $entity
        ];
    }
}
