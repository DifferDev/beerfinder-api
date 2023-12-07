<?php

namespace BeerFinder\Application\UseCase\Interfaces;

interface QueryInterface
{
    /**
     * @param object $query
     * @return object[]
     */
    public function handle(object $query): array;
}
