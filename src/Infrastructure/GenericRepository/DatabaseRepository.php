<?php

namespace BeerFinder\Infrastructure\GenericRepository;

use BeerFinder\Domain\ValueObject\Id;
use BeerFinder\Infrastructure\GenericRepository\Interfaces\RepositoryInterface;
use Exception;
use Laminas\Hydrator\ObjectPropertyHydrator;

class DatabaseRepository implements RepositoryInterface
{
    protected string $collectionName;

    /**
     * @var class-string
     */
    protected string $mapClassName = 'stdClass';

    public function __construct(
        protected \PDO $connection,
        protected ObjectPropertyHydrator $hydrator
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

        if (false === $entity = $statement->fetchObject($this->mapClassName)) {
            throw new \Exception('Entity not found');
        }
        return $entity;
    }

    public function findAll(): array
    {
        $query = <<<SQL
            SELECT * 
            FROM $this->collectionName
        SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute();

        $entities = $statement->fetchAll(\PDO::FETCH_CLASS, $this->mapClassName);

        if (0 === count($entities)) {
            return [];
        }
        return $entities;
    }

    /**
     * @param BaseEntity $entity
     * @return void
     * @throws Exception
     */
    public function save(BaseEntity $entity): void
    {
        if (false === isset($entity->id)) {
            $entity->id = new Id($this->insert($entity));
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
        $fields = [];

        /**
         * @var array<string, string> $entityFields
         */
        $entityFields = $this->hydrator->extract($entity);

        foreach ($entityFields as $column => $value) {
            $value = (string)$value;
            $fields[] = "$column='$value'";
        }
        $fieldsToQuery = implode(', ', $fields);

        $query = <<<SQL
            UPDATE $this->collectionName
            SET $fieldsToQuery
            WHERE id = $entity->id
        SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute();
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
