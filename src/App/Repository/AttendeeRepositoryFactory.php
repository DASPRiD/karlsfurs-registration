<?php
namespace App\Repository;

use App\Entity\Attendee;
use Interop\Container\ContainerInterface;

class AttendeeRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new AttendeeRepository(
            $container->get('doctrine.entity_manager.orm_default')->getRepository(Attendee::class)
        );
    }
}
