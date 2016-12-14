<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Repository\Group;

use Doctrine\Common\Persistence\ObjectRepository;
use Suitwalk\Domain\Group\GetAllGroupsInterface;

final class GetAllGroups implements GetAllGroupsInterface
{
    /**
     * @var ObjectRepository
     */
    private $repository;

    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll() : array
    {
        return $this->repository->findBy([], ['priority' => 'asc']);
    }
}
