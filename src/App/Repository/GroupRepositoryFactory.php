<?php
namespace App\Repository;

use App\Entity\Group;
use Interop\Container\ContainerInterface;

class GroupRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new GroupRepository($container->get('doctrine.entity_manager.orm_default')->getRepository(Group::class));
    }
}
