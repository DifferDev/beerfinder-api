<?php

namespace BeerFinder\Application\UseCase\Beer;

use BeerFinder\Application\UseCase\Interfaces\QueryInterface;
use BeerFinder\Domain\Model\Beer;
use BeerFinder\Infrastructure\GenericRepository\Interfaces\RepositoryInterface;
use Laminas\Hydrator\ClassMethodsHydrator;

class SearchBeerQuery implements QueryInterface
{
    public function __construct(
        protected RepositoryInterface $repository,
        protected ClassMethodsHydrator $hydrator
    ) {
    }

    /**
     * @param object{id: int|string} $query
     * @return array<string, array<string, array|mixed[]>>
     */
    public function handle(object $query): array
    {
        $this->repository->setCollection('beers');
        try {
            $result = $this->repository->findById($query->id);
            return [
                'result' => $this->hydrator->extract($result)
            ];
        } catch (\Exception $exception) {
            return [];
        }

    }
}
