<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Repository\Attendee;

use Doctrine\Common\Persistence\ObjectRepository;
use Suitwalk\Domain\Attendee\SearchAttendeesByEmailAddressInterface;
use Suitwalk\Domain\Event\Event;

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

    public function __invoke(Event $event, string $emailAddress) : array
    {
        return $this->repository->findBy([
            'event' => $event,
            'emailAddress' => $emailAddress
        ], ['sequenceNumber' => 'asc']);
    }
}
