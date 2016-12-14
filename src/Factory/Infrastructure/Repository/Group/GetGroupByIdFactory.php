<?php
namespace Suitwalk\Factory\Infrastructure\Repository\Group;

use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use Suitwalk\Domain\Group\Group;
use Suitwalk\Infrastructure\Repository\Group\GetGroupById;

final class GetGroupByIdFactory
{
    public function __invoke(ContainerInterface $container) : GetGroupById
    {
        return new GetGroupById(
            $container->get(EntityManagerInterface::class)->getRepository(Group::class)
        );
    }
}
