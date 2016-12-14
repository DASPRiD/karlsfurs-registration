<?php
namespace Suitwalk\Factory\Infrastructure\Template\Extension;

use Interop\Container\ContainerInterface;
use Suitwalk\Infrastructure\Options\SuitwalkOptions;
use Suitwalk\Infrastructure\Template\Extension\SuitwalkOptionsExtension;

final class SuitwalkOptionsExtensionFactory
{
    public function __invoke(ContainerInterface $container) : SuitwalkOptionsExtension
    {
        return new SuitwalkOptionsExtension(
            $container->get(SuitwalkOptions::class)
        );
    }
}
