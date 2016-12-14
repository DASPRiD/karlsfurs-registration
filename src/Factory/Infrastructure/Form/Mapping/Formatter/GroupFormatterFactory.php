<?php
namespace Suitwalk\Factory\Infrastructure\Form\Mapping\Formatter;

use Interop\Container\ContainerInterface;
use Suitwalk\Domain\Group\GetGroupByIdInterface;
use Suitwalk\Infrastructure\Form\Mapping\Formatter\GroupFormatter;

final class GroupFormatterFactory
{
    public function __invoke(ContainerInterface $container) : GroupFormatter
    {
        return new GroupFormatter(
            $container->get(GetGroupByIdInterface::class)
        );
    }
}
