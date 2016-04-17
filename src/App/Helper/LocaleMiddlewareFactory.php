<?php
namespace App\Helper;

use Interop\Container\ContainerInterface;
use Zend\I18n\Translator\TranslatorInterface;
use Zend\Session\Container;

class LocaleMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new LocaleMiddleware(
            $container->get(TranslatorInterface::class),
            new Container('locale')
        );
    }
}
