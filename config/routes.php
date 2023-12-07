<?php

global $app;

use BeerFinder\Controllers\BeerController;
use BeerFinder\Controllers\BeerLocationController;
use BeerFinder\Infrastructure\GenericRepository\DatabaseRepository;

$app->get('/beersLocation', [BeerLocationController::class, 'getBeerLocations']);

$app->get('/beers/{id}', [BeerController::class, 'searchBeer']);