<?php
namespace Suitwalk\Factory\Infrastructure\Handler;

use Interop\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Suitwalk\Domain\Medium\GetAllMediaInterface;
use Suitwalk\Infrastructure\Handler\MediaHandler;
use Suitwalk\Infrastructure\Response\HtmlResponseRenderer;

final class MediaHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        return new MediaHandler(
            $container->get(GetAllMediaInterface::class),
            $container->get(HtmlResponseRenderer::class)
        );
    }
}
