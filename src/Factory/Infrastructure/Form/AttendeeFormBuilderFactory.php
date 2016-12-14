<?php
namespace Suitwalk\Factory\Infrastructure\Form;

use Interop\Container\ContainerInterface;
use Suitwalk\Infrastructure\Form\AttendeeFormBuilder;
use Suitwalk\Infrastructure\Form\Mapping\Formatter\GroupFormatter;

final class AttendeeFormBuilderFactory
{
    public function __invoke(ContainerInterface $container) : AttendeeFormBuilder
    {
        return new AttendeeFormBuilder(
            $container->get(GroupFormatter::class)
        );
    }
}
