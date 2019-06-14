<?php
namespace Suitwalk\Factory\Infrastructure\Handler;

use Interop\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Suitwalk\Domain\Event\GetAllEventsInterface;
use Suitwalk\Infrastructure\Handler\ICalHandler;

final class ICalHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        return new ICalHandler(
            $container->get(GetAllEventsInterface::class)
        );
    }
}
