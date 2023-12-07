<?php

namespace BeerFinder\Application\UseCase\Beer;

use BeerFinder\Application\UseCase\Interfaces\QueryInterface;
use BeerFinder\Domain\Model\Beer;
use BeerFinder\Infrastructure\GenericRepository\DatabaseRepository;
use BeerFinder\Infrastructure\GenericRepository\Interfaces\RepositoryInterface;
use Laminas\Hydrator\ClassMethodsHydrator;

class SearchBeerQuery implements QueryInterface
{
    public function __construct(
        protected DatabaseRepository $repository,
        protected ClassMethodsHydrator $hydrator
    ) {
    }

    /**
     * @param object{id: int|string|mixed} $query
     * @return array<string, array>
     */
    public function handle(object $query): array
    {
        if (false === isset($query->id)) {
            throw new \Exception('Id not provided');
        }

        $this->repository->setCollection('beers');
        $this->repository->setMapClassName(Beer::class);

        $entity = $this->repository->findById($query->id);

        return [
            'result' => $this->hydrator->extract($entity)
        ];
    }
}
