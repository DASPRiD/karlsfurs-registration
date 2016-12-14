<?php
namespace Suitwalk\Factory\Infrastructure\Middleware;

use DASPRiD\Helios\CookieManagerInterface;
use Interop\Container\ContainerInterface;
use Suitwalk\Infrastructure\Middleware\Logout;
use Zend\Expressive\Helper\UrlHelper;

final class LogoutFactory
{
    public function __invoke(ContainerInterface $container) : Logout
    {
        return new Logout(
            $container->get(CookieManagerInterface::class),
            $container->get(UrlHelper::class)
        );
    }
}
