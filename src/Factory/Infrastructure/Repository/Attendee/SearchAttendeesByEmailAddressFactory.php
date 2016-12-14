<?php
namespace Suitwalk\Factory\Infrastructure\Repository\Attendee;

use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use Suitwalk\Domain\Attendee\Attendee;
use Suitwalk\Infrastructure\Repository\Attendee\SearchAttendeesByEmailAddress;

final class SearchAttendeesByEmailAddressFactory
{
    public function __invoke(ContainerInterface $container) : SearchAttendeesByEmailAddress
    {
        return new SearchAttendeesByEmailAddress(
            $container->get(EntityManagerInterface::class)->getRepository(Attendee::class)
        );
    }
}
