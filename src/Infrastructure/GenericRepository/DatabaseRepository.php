<?php

namespace BeerFinder\Infrastructure\GenericRepository;

use BeerFinder\Domain\ValueObject\Id;
use BeerFinder\Infrastructure\GenericRepository\Interfaces\RepositoryInterface;
use Exception;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\ObjectPropertyHydrator;
use Laminas\Hydrator\Strategy\CollectionStrategy;

class DatabaseRepository implements RepositoryInterface
{
    protected string $collectionName;

    /**
     * @var class-string
     */
    protected string $mapClassName = 'stdClass';

    public function __construct(
        protected \PDO $connection,
        protected ClassMethodsHydrator $hydrator
    ) {
    }

    public function setCollection(string $collectionName): void
    {
        $this->collectionName = $collectionName;
    }

    /**
     * @template T of object
     * @param class-string<T> $mapClassName
     * @return void
     */
    public function setMapClassName(string $mapClassName): void
    {
        $this->mapClassName = $mapClassName;
    }

    /**
     * @param int|string $id
     * @return object
     * @throws Exception
     */
    public function findById(int|string $id): object
    {
        $query = <<<SQL
            SELECT * 
            FROM $this->collectionName
            WHERE id = ?
        SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute([$id]);

        $entityArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (false === $entityArray) {
            throw new \Exception('Error on get entity');
        }

        $entityObject = new $this->mapClassName();
        $this->hydrator->hydrate((array)$entityArray, $entityObject);

        return $entityObject;
    }

    /**
     * @return array<object|BaseEntity>
     */
    public function findAll(): array
    {
        $query = <<<SQL
            SELECT * 
            FROM $this->collectionName
        SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute();

        $entities = $statement->fetchAll(\PDO::FETCH_ASSOC);

        if (0 === count($entities)) {
            return [];
        }

        $collectionHydrator = new CollectionStrategy(
            $this->hydrator,
            $this->mapClassName
        );
        return $collectionHydrator->hydrate($entities);
    }

    /**
     * @param BaseEntity $entity
     * @return void
     * @throws Exception
     */
    public function save(BaseEntity $entity): void
    {
        if (null === $entity->getId()) {
            $entity->setId((int)$this->insert($entity));
            return;
        }
        $this->update($entity);
    }

    public function delete(object $entity): void
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param BaseEntity $entity
     * @return void
     * @throws Exception
     */
    private function update(BaseEntity $entity): void
    {
        /**
         * @var array<string, string> $entityFields
         */
        $entityFields = $this->hydrator->extract($entity);

        $fields = [];
        foreach ($entityFields as $column => $value) {
            if ($column === 'id') {
                continue;
            }
            $fields[] = "$column=:$column";
        }
        $fieldsToQuery = implode(', ', $fields);

        $query = <<<SQL
            UPDATE $this->collectionName
            SET $fieldsToQuery
            WHERE id = :id
        SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute($entityFields);
    }

    /**
     * @param BaseEntity $entity
     * @return string
     * @throws Exception
     */
    private function insert(BaseEntity $entity): string
    {
        /**
         * @var array<string, string> $entityFields
         */
        $entityFields = $this->hydrator->extract($entity);
        unset($entityFields['id']);

        $fields = implode(', ', array_keys($entityFields));
        $values = [];

        foreach ($entityFields as $value) {
            $values[] = "'$value'";
        }

        $valuesQuery = implode(', ', $values);

        $query = <<<SQL
            INSERT INTO $this->collectionName
            ($fields)
            VALUES
            ($valuesQuery)
        SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute();

        $lastInsertedId = $this->connection->lastInsertId();
        if (false === $lastInsertedId) {
            throw new \Exception('Saved ID was not retrieved from DB');
        }
        return $lastInsertedId;
    }
}
