<?php

use BeerFinder\Application\UseCase\Beer\SearchBeerQuery;
use BeerFinder\Controllers\BeerController;
use BeerFinder\Controllers\BeerLocationController;
use BeerFinder\Infrastructure\GenericRepository\DatabaseRepository;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\NamingStrategy\UnderscoreNamingStrategy;

$global = [
    PDO::class => function () {
        $dbname = getenv('DATABASE_NAME');
        $hostname = getenv('DATABASE_HOST');
        $user = getenv('DATABASE_USERNAME') ? getenv('DATABASE_USERNAME') : '';
        $password = getenv('DATABASE_PASSWORD') ? getenv('DATABASE_PASSWORD') : '';

        $pdo = new PDO("mysql:dbname=$dbname;host=$hostname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    },

    ClassMethodsHydrator::class => function () {
        $hydrator = new ClassMethodsHydrator();
        $hydrator->setNamingStrategy(new UnderscoreNamingStrategy());
        return $hydrator;
    },

    DatabaseRepository::class =>
        fn($c) => new DatabaseRepository($c->get(PDO::class), $c->get(ClassMethodsHydrator::class))
];

$application = [
    SearchBeerQuery::class => fn($c) => new SearchBeerQuery(
        $c->get(DatabaseRepository::class),
        $c->get(ClassMethodsHydrator::class)
    )
];

$controller = [

    BeerLocationController::class => fn($c) => new BeerLocationController(
            $c->get(DatabaseRepository::class),
            $c->get(ClassMethodsHydrator::class)
       ),

    BeerController::class => fn($c) => new BeerController($c->get(SearchBeerQuery::class))

];

return [...$global, ...$application, ...$controller];