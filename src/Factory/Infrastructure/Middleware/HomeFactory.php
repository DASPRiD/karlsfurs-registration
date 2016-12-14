<?php
namespace Suitwalk\Factory\Infrastructure\Middleware;

use Interop\Container\ContainerInterface;
use Suitwalk\Domain\Attendee\ReplaceAttendeesInterface;
use Suitwalk\Domain\Attendee\SearchAttendeesByEmailAddressInterface;
use Suitwalk\Domain\Group\GetAllGroupsInterface;
use Suitwalk\Infrastructure\Form\AttendeeFormBuilder;
use Suitwalk\Infrastructure\Middleware\Home;
use Suitwalk\Infrastructure\Options\SuitwalkOptions;
use Suitwalk\Infrastructure\Response\HtmlResponseRenderer;

final class HomeFactory
{
    public function __invoke(ContainerInterface $container) : Home
    {
        return new Home(
            $container->get(SuitwalkOptions::class),
            $container->get(GetAllGroupsInterface::class),
            $container->get(SearchAttendeesByEmailAddressInterface::class),
            $container->get(ReplaceAttendeesInterface::class),
            $container->get(AttendeeFormBuilder::class),
            $container->get(HtmlResponseRenderer::class)
        );
    }
}
