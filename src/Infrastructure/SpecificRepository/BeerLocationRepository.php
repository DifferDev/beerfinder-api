<?php

namespace BeerFinder\Infrastructure\SpecificRepository;

class BeerLocationRepository implements BeerLocationRepositoryInterface
{
    public function __construct(
        protected \PDO $pdo
    ) {
    }

    public function getBeersByLocation(float $latitude, float $longitude): array
    {
        $query = <<<QUERY
            SELECT
                locations.id,
                b.name,
                b.type,
                b.price,
                locations.latitude,
                locations.longitude
            FROM locations
            INNER JOIN beers b
                on locations.beer_id = b.id
            WHERE 6371 * 2 * ASIN(
                SQRT(
                        POW(SIN((RADIANS(:search_latitude) - RADIANS(latitude)) / 2), 2) +
                        COS(RADIANS(:search_latitude)) * COS(RADIANS(latitude)) *
                        POW(SIN((RADIANS(:search_longitude) - RADIANS(longitude)) / 2), 2)
                )
            ) < 1.1;
        QUERY;

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':search_latitude', $latitude);
        $statement->bindValue(':search_longitude', $longitude);

        $statement->execute();

        $beerLocations = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if (!$beerLocations) {
            return [];
        }
        // gerar hidratação
        return $beerLocations;
    }
}
