<?php

namespace BeerFinder\Infrastructure\GenericRepository;

use BeerFinder\Domain\ValueObject\Id;

class BaseEntity
{
    private Id|null $id = null;
    public function setId(string|int $id): void
    {
        $this->id = new Id($id);
    }

    public function getId(): int|string|null
    {
        return $this->id;
    }
}
