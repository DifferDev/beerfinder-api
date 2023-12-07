<?php

use BeerFinder\Domain\Model\Beer;
use BeerFinder\Infrastructure\GenericRepository\DatabaseRepository;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\NamingStrategy\UnderscoreNamingStrategy;
use Laminas\Hydrator\Strategy\CollectionStrategy;
use Laminas\Hydrator\Strategy\SerializableStrategy;
use Laminas\Serializer\Adapter\Json;
use Peroxide\DependencyInjection\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

AppFactory::setContainer(
    new Container(require __DIR__ . '/../config/dependencies.php')
);

$app = AppFactory::create();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

require __DIR__ . '/../config/routes.php';

$app->run();