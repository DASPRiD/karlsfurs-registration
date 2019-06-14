<?php
namespace Suitwalk\Factory\Infrastructure\Handler;

use Interop\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Suitwalk\Domain\Event\GetLatestEventInterface;
use Suitwalk\Domain\Group\GetAllGroupsInterface;
use Suitwalk\Infrastructure\Handler\SvgHandler;
use Zend\Expressive\Template\TemplateRendererInterface;

final class SvgHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        return new SvgHandler(
            $container->get(GetLatestEventInterface::class),
            $container->get(GetAllGroupsInterface::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
