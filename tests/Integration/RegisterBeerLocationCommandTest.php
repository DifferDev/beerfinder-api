<?php

namespace Integration;

use BeerFinder\Application\UseCase\Location\RegisterBeerLocationCommand;
use BeerFinder\Domain\Model\Location;
use BeerFinder\Infrastructure\GenericRepository\Interfaces\RepositoryInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(RegisterBeerLocationCommand::class)]
class RegisterBeerLocationCommandTest extends TestCase
{
    public function testRegisterBeerLocationCommandShouldRegisterABeerLocation(): void
    {
        $location = new Location();
        $location->setBeerId(8);
        $location->setLatitude(-23.5686);
        $location->setLongitude(-46.6280);

        $repository = \Mockery::mock(RepositoryInterface::class);
        $repository->shouldReceive('save')
            ->with($location)
            ->andReturnUsing(function ($entity) {
                $entity->setId(1);
            })
        ;

        $registerBeerLocationCommand = new RegisterBeerLocationCommand($repository);
        $registerBeerLocationCommand->setParameters($location);
        $registerBeerLocationCommand->execute();

        $this->assertEquals(1, $location->getId());
    }
}