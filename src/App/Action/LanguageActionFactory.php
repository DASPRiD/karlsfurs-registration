<?php
namespace App\Action;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Session\Container;

class LanguageActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new LanguageAction(
            new Container('locale'),
            $container->get(UrlHelper::class)
        );
    }
}
