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
        /**
         * @var DatabaseRepository $repository
         */
        protected RepositoryInterface $repository,
        protected ClassMethodsHydrator $hydrator
    ) {
    }

    /**
     * @param object{id: int|string} $query
     * @return array<string, array<object>|array<string, mixed>>
     */
    public function handle(object $query): array
    {
        $this->repository->setCollection('beers');
        $this->repository->setMapClassName(Beer::class);
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
