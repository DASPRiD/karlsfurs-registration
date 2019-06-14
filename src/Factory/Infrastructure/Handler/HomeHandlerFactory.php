<?php
namespace Suitwalk\Factory\Infrastructure\Handler;

use Interop\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Suitwalk\Domain\Attendee\ReplaceAttendeesInterface;
use Suitwalk\Domain\Attendee\SearchAttendeesByEmailAddressInterface;
use Suitwalk\Domain\Event\GetLatestEventInterface;
use Suitwalk\Domain\Group\GetAllGroupsInterface;
use Suitwalk\Infrastructure\Form\AttendeeFormBuilder;
use Suitwalk\Infrastructure\Handler\HomeHandler;
use Suitwalk\Infrastructure\Options\SuitwalkOptions;
use Suitwalk\Infrastructure\Response\HtmlResponseRenderer;

final class HomeHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        return new HomeHandler(
            $container->get(SuitwalkOptions::class),
            $container->get(GetLatestEventInterface::class),
            $container->get(GetAllGroupsInterface::class),
            $container->get(SearchAttendeesByEmailAddressInterface::class),
            $container->get(ReplaceAttendeesInterface::class),
            $container->get(AttendeeFormBuilder::class),
            $container->get(HtmlResponseRenderer::class)
        );
    }
}
