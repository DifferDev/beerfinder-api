<?php

namespace BeerFinder\Application\UseCase\Beer;

use BeerFinder\Application\UseCase\Interfaces\QueryInterface;
use BeerFinder\Domain\Model\Beer;
use BeerFinder\Infrastructure\GenericRepository\Interfaces\RepositoryInterface;

class SearchBeerQuery implements QueryInterface
{
    public function __construct(
        protected RepositoryInterface $repository
    ) {
    }

    /**
     * @param object{id: int|string} $query
     * @return array<string, object>
     */
    public function handle(object $query): array
    {
        $this->repository->setCollection('beers');
        try {
            $result = $this->repository->findById($query->id);
            return [
                'result' => $result
            ];
        } catch (\Exception $exception) {
            return [];
        }

    }
}
