<?php
namespace App\Action;

use App\Helper\LoginHelper;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;

class LogoutActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new LogoutAction(
            $container->get(LoginHelper::class),
            $container->get(UrlHelper::class)
        );
    }
}
