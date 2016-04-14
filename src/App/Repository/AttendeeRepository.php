<?php
namespace App\Repository;

use App\Entity\Attendee;
use Doctrine\ORM\EntityRepository;

class AttendeeRepository
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
     * @param string $emailAddress
     * @return Attendee|null
     */
    public function findOneByEmailAddress($emailAddress)
    {
        return $this->entityRepository->findOneBy([
            'emailAddress' => strtolower($emailAddress),
        ]);
    }
}
