<?php
namespace Suitwalk\Factory\Infrastructure\Middleware;

use Interop\Container\ContainerInterface;
use Suitwalk\Domain\Group\GetAllGroupsInterface;
use Suitwalk\Domain\History\GetHistoryInterface;
use Suitwalk\Infrastructure\Middleware\History;
use Suitwalk\Infrastructure\Response\HtmlResponseRenderer;

final class HistoryFactory
{
    public function __invoke(ContainerInterface $container) : History
    {
        return new History(
            $container->get(GetAllGroupsInterface::class),
            $container->get(GetHistoryInterface::class),
            $container->get(HtmlResponseRenderer::class)
        );
    }
}
