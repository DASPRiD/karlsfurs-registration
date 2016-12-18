<?php
namespace Suitwalk\Factory\Infrastructure\Middleware;

use Interop\Container\ContainerInterface;
use Suitwalk\Domain\Medium\GetAllMediaInterface;
use Suitwalk\Infrastructure\Middleware\Media;
use Suitwalk\Infrastructure\Response\HtmlResponseRenderer;

final class MediaFactory
{
    public function __invoke(ContainerInterface $container) : Media
    {
        return new Media(
            $container->get(GetAllMediaInterface::class),
            $container->get(HtmlResponseRenderer::class)
        );
    }
}
