<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Repository\Attendee;

use Doctrine\Common\Persistence\ObjectRepository;
use Suitwalk\Domain\Attendee\SearchAttendeesByEmailAddressInterface;

final class SearchAttendeesByEmailAddress implements SearchAttendeesByEmailAddressInterface
{
    /**
     * @var ObjectRepository
     */
    private $repository;

    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function searchByEmailAddress(string $emailAddress) : array
    {
        return $this->repository->findBy(['emailAddress' => $emailAddress], ['sequenceNumber' => 'asc']);
    }
}
