<?php
namespace App\Helper;

use Interop\Container\ContainerInterface;
use Zend\I18n\Translator\TranslatorInterface;

class MessageFormatHelperFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new MessageFormatHelper(
            $container->get(TranslatorInterface::class)->getLocale()
        );
    }
}
