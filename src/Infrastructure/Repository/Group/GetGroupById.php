<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Repository\Group;

use Doctrine\Common\Persistence\ObjectRepository;
use Suitwalk\Domain\Group\Exception\GroupNotFoundException;
use Suitwalk\Domain\Group\GetGroupByIdInterface;
use Suitwalk\Domain\Group\Group;

final class GetGroupById implements GetGroupByIdInterface
{
    /**
     * @var ObjectRepository
     */
    private $repository;

    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getById(int $groupId) : Group
    {
        $group = $this->repository->find($groupId);

        if (null === $group) {
            throw GroupNotFoundException::fromNonExistentId($groupId);
        }

        return $group;
    }
}
