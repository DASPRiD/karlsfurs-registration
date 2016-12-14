<?php
namespace Suitwalk\Factory\Infrastructure\Repository\Group;

use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use Suitwalk\Domain\Group\Group;
use Suitwalk\Infrastructure\Repository\Group\GetAllGroups;

final class GetAllGroupsFactory
{
    public function __invoke(ContainerInterface $container) : GetAllGroups
    {
        return new GetAllGroups(
            $container->get(EntityManagerInterface::class)->getRepository(Group::class)
        );
    }
}
