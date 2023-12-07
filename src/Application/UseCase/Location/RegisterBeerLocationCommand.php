<?php

namespace BeerFinder\Application\UseCase\Location;

use BeerFinder\Application\UseCase\Interfaces\CommandInterface;
use BeerFinder\Domain\Model\Location;
use BeerFinder\Infrastructure\GenericRepository\Interfaces\RepositoryInterface;

class RegisterBeerLocationCommand implements CommandInterface
{
    protected Location $parameters;

    public function __construct(
        protected RepositoryInterface $repository
    ) {
    }

    public function setParameters(Location $parameters): void
    {
        $this->parameters = $parameters;
    }

    public function execute(): void
    {
        // Domain validation
        $this->repository->save($this->parameters);
    }
}
