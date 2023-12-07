<?php

namespace BeerFinder\Application\UseCase\Interfaces;

interface CommandInterface
{
    public function execute(): void;
}
