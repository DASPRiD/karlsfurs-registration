<?php
namespace Suitwalk\Factory\Infrastructure\Handler;

use DASPRiD\Helios\IdentityCookieManager;
use Interop\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Suitwalk\Infrastructure\Handler\LogoutHandler;
use Zend\Expressive\Helper\UrlHelper;

final class LogoutHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        return new LogoutHandler(
            $container->get(IdentityCookieManager::class),
            $container->get(UrlHelper::class)
        );
    }
}
