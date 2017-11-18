<?php
namespace Suitwalk\Factory\Infrastructure\Repository\Event;

use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use Suitwalk\Domain\Event\Event;
use Suitwalk\Domain\Event\GetLatestEventInterface;
use Suitwalk\Infrastructure\Repository\Event\GetLatestEvent;

final class GetLatestEventFactory
{
    public function __invoke(ContainerInterface $container) : GetLatestEventInterface
    {
        return new GetLatestEvent(
            $container->get(EntityManagerInterface::class)->getRepository(Event::class)
        );
    }
}
