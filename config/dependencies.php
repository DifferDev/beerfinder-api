<?php

use BeerFinder\Application\UseCase\Beer\SearchBeerQuery;
use BeerFinder\Controller\BeerController;
use BeerFinder\Infrastructure\GenericRepository\DatabaseRepository;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\NamingStrategy\UnderscoreNamingStrategy;

$globals = [
    \PDO::class => function () {
        $database = getenv('DATABASE_NAME');
        $user = getenv('DATABASE_USERNAME');
        $password = getenv('DATABASE_PASSWORD');
        $host = getenv('DATABASE_HOST');

        $pdo = new \PDO("mysql:dbname=$database;host=$host", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    },

    DatabaseRepository::class => fn($container) => new DatabaseRepository(
        $container->get(\PDO::class),
        $container->get(ClassMethodsHydrator::class)
    ),

    ClassMethodsHydrator::class => function () {
        $hydrator = new ClassMethodsHydrator();
        $hydrator->setNamingStrategy(new UnderscoreNamingStrategy());
        return $hydrator;
    }
];

$controllers = [
    BeerController::class =>
        fn($c) => new BeerController($c->get(SearchBeerQuery::class))
];

$useCases = [
    SearchBeerQuery::class =>
        fn($c) => new SearchBeerQuery($c->get(DatabaseRepository::class))
];

return [
    ...$globals,
    ...$controllers,
    ...$useCases
];