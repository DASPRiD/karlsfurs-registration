<?php
namespace Suitwalk\Factory\Infrastructure\Repository\Attendee;

use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use Suitwalk\Infrastructure\Repository\Attendee\ReplaceAttendees;

final class ReplaceAttendeesFactory
{
    public function __invoke(ContainerInterface $container) : ReplaceAttendees
    {
        return new ReplaceAttendees(
            $container->get(EntityManagerInterface::class)
        );
    }
}
