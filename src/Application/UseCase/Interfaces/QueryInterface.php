<?php

namespace BeerFinder\Application\UseCase\Interfaces;

interface QueryInterface
{
    /**
     * @param object $query
     * @return array<string, array<object>|array<string, mixed>>
     */
    public function handle(object $query): array;
}
