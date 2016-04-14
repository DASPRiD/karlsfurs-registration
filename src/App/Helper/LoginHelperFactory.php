<?php
namespace App\Helper;

use Interop\Container\ContainerInterface;
use Zend\Session\Container;

class LoginHelperFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new LoginHelper(
            new Container('login')
        );
    }
}
