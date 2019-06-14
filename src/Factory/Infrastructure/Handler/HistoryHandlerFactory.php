<?php
namespace Suitwalk\Factory\Infrastructure\Handler;

use Interop\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Suitwalk\Domain\Group\GetAllGroupsInterface;
use Suitwalk\Domain\History\GetHistoryInterface;
use Suitwalk\Infrastructure\Handler\HistoryHandler;
use Suitwalk\Infrastructure\Response\HtmlResponseRenderer;

final class HistoryHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        return new HistoryHandler(
            $container->get(GetAllGroupsInterface::class),
            $container->get(GetHistoryInterface::class),
            $container->get(HtmlResponseRenderer::class)
        );
    }
}
