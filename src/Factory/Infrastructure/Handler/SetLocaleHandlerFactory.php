<?php
namespace Suitwalk\Factory\Infrastructure\Handler;

use Interop\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Suitwalk\Infrastructure\Handler\SetLocaleHandler;
use Zend\Expressive\Helper\UrlHelper;

final class SetLocaleHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        return new SetLocaleHandler(
            $container->get(UrlHelper::class)
        );
    }
}
