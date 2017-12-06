<?php
namespace Suitwalk\Factory\Infrastructure\Middleware;

use Interop\Container\ContainerInterface;
use Suitwalk\Domain\Event\GetAllEventsInterface;
use Suitwalk\Infrastructure\Middleware\ICal;

final class ICalFactory
{
    public function __invoke(ContainerInterface $container) : ICal
    {
        return new ICal(
            $container->get(GetAllEventsInterface::class)
        );
    }
}
