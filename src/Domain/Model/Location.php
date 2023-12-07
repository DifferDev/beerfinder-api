<?php

namespace BeerFinder\Domain\Model;

use BeerFinder\Domain\ValueObject\Id;
use BeerFinder\Infrastructure\GenericRepository\BaseEntity;

class Location extends BaseEntity
{
    private Id $beerId;

    private float|string $latitude;

    private float|string $longitude;

    public function getBeerId(): int|string
    {
        return $this->beerId->getValue();
    }

    public function setBeerId(int|string $beerId): void
    {
        $this->beerId = new Id($beerId);
    }

    public function getLatitude(): float|string
    {
        return $this->latitude;
    }

    public function setLatitude(float|string $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): float|string
    {
        return $this->longitude;
    }

    public function setLongitude(float|string $longitude): void
    {
        $this->longitude = $longitude;
    }
}
