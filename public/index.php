<?php

use BeerFinder\Domain\Model\Beer;
use BeerFinder\Infrastructure\GenericRepository\DatabaseRepository;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\NamingStrategy\UnderscoreNamingStrategy;
use Laminas\Hydrator\Strategy\CollectionStrategy;
use Laminas\Hydrator\Strategy\SerializableStrategy;
use Laminas\Serializer\Adapter\Json;

require __DIR__ . '/../vendor/autoload.php';

$pdo = new PDO('mysql:dbname=beerfinder;host=mariadb', 'root', '123456');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$hydrator = new ClassMethodsHydrator();
$hydrator->setNamingStrategy(new UnderscoreNamingStrategy());


$repository = new DatabaseRepository($pdo, $hydrator);

try {
    $repository->setCollection('beers');
    $repository->setMapClassName(Beer::class);

    $beers = $repository->findAll();
    $beer = $repository->findById(10);

    $collectionHydrator = new CollectionStrategy(
        $hydrator,
        Beer::class
    );

    echo json_encode($hydrator->extract($beer), JSON_THROW_ON_ERROR|JSON_PRETTY_PRINT, 512) . PHP_EOL;
//    echo json_encode(
//        $collectionHydrator->extract($beers),
//        JSON_PRETTY_PRINT
//    );

} catch (\Exception $ex) {
    echo $ex->getMessage();
}
