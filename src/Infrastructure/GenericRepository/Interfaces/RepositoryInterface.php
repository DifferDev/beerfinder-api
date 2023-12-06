<?php

namespace BeerFinder\Infrastructure\GenericRepository\Interfaces;

use BeerFinder\Infrastructure\GenericRepository\BaseEntity;

interface RepositoryInterface
{
    /**
     * @param string $collectionName
     * @return void
     */
    public function setCollection(string $collectionName): void;

    /**
     * @param int|string $id
     * @return object
     */
    public function findById(int|string $id): object;

    /**
     * @return array<BaseEntity>
     */
    public function findAll(): array;

    /**
     * @param BaseEntity $entity
     * @return void
     */
    public function save(BaseEntity $entity): void;

    /**
     * @param object $entity
     * @return void
     */
    public function delete(object $entity): void;
}
