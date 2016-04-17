<?php
namespace App\Helper;

use App\Options\SuitwalkOptions;
use Interop\Container\ContainerInterface;

class SuitwalkOptionsHelperFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new SuitwalkOptionsHelper(
            $container->getServiceLocator()->get(SuitwalkOptions::class)
        );
    }
}
