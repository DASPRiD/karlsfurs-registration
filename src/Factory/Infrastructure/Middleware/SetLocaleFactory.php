<?php
namespace Suitwalk\Factory\Infrastructure\Middleware;

use Interop\Container\ContainerInterface;
use Suitwalk\Infrastructure\Middleware\SetLocale;
use Zend\Expressive\Helper\UrlHelper;

final class SetLocaleFactory
{
    public function __invoke(ContainerInterface $container) : SetLocale
    {
        return new SetLocale(
            $container->get(UrlHelper::class)
        );
    }
}
