<?php

use BeerFinder\Controller\BeerController;
use BeerFinder\Controller\BeerLocationController;
use Peroxide\DependencyInjection\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$dependencies = require __DIR__ . '/../config/dependencies.php';

AppFactory::setContainer(
    new Container($dependencies)
);

$app = AppFactory::create();

$app->get('/beers/{id}', [ BeerController::class, 'get' ]);
$app->get(
    '/beers/locations/{latitude}/{longitude}',
    [ BeerLocationController::class, 'get' ]
);

$app->run();