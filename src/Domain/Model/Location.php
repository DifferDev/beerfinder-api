<?php

namespace BeerFinder\Domain\Model;

use BeerFinder\Domain\ValueObject\Id;
use BeerFinder\Infrastructure\GenericRepository\BaseEntity;

class Location extends BaseEntity
{
    private Id $beerId;

    private float $latitude;

    private float $longitude;

    public function getBeerId(): int|string
    {
        return $this->beerId->getValue();
    }

    public function setBeerId(int|string $beerId): void
    {
        $this->beerId = new Id($beerId);
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }
}
