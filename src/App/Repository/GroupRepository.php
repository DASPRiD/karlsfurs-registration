<?php
namespace App\Repository;

use App\Entity\Group;
use Doctrine\ORM\EntityRepository;

class GroupRepository
{
    /**
     * @var EntityRepository
     */
    private $entityRepository;

    /**
     * @param EntityRepository $entityRepository
     */
    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    /**
     * @return Group[]
     */
    public function findAll()
    {
        return $this->entityRepository->findBy([], ['priority' => 'ASC']);
    }

    /**
     * @param int $id
     * @return Group|null
     */
    public function findOneById($id)
    {
        return $this->entityRepository->findOneBy(['id' => $id]);
    }
}
