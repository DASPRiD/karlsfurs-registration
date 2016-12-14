<?php
namespace Suitwalk\Factory\Infrastructure\Template\Extension;

use Interop\Container\ContainerInterface;
use Suitwalk\Infrastructure\Template\Extension\TranslateExtension;
use Zend\I18n\Translator\TranslatorInterface;

final class TranslateExtensionFactory
{
    public function __invoke(ContainerInterface $container) : TranslateExtension
    {
        return new TranslateExtension(
            $container->get(TranslatorInterface::class)
        );
    }
}
