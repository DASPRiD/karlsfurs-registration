<?php
namespace App\Options;

use Interop\Container\ContainerInterface;

class SuitwalkOptionsFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new SuitwalkOptions(
            $container->get('config')['suitwalk']
        );
    }
}
