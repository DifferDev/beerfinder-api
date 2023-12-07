<?php

namespace BeerFinder\Application\UseCase\Interfaces;

interface CommandInterface
{
    public function setParameters(object $parameters): void;
    public function execute(): void;
}