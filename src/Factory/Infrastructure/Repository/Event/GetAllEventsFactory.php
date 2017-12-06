<?php
namespace Suitwalk\Factory\Infrastructure\Repository\Event;

use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use Suitwalk\Domain\Event\Event;
use Suitwalk\Domain\Event\GetAllEventsInterface;
use Suitwalk\Infrastructure\Repository\Event\GetAllEvents;

final class GetAllEventsFactory
{
    public function __invoke(ContainerInterface $container) : GetAllEventsInterface
    {
        return new GetAllEvents(
            $container->get(EntityManagerInterface::class)->getRepository(Event::class)
        );
    }
}
