<?php
namespace Suitwalk\Factory\Infrastructure\Middleware;

use Interop\Container\ContainerInterface;
use Suitwalk\Domain\Event\GetLatestEventInterface;
use Suitwalk\Domain\Group\GetAllGroupsInterface;
use Suitwalk\Infrastructure\Middleware\Svg;
use Zend\Expressive\Template\TemplateRendererInterface;

final class SvgFactory
{
    public function __invoke(ContainerInterface $container) : Svg
    {
        return new Svg(
            $container->get(GetLatestEventInterface::class),
            $container->get(GetAllGroupsInterface::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
