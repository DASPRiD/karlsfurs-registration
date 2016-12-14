<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Repository\Attendee;

use Doctrine\ORM\EntityManagerInterface;
use Suitwalk\Domain\Attendee\ReplaceAttendeesInterface;

final class ReplaceAttendees implements ReplaceAttendeesInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function replaceAttendees(array $existingAttendees, array $newAttendees)
    {
        $this->entityManager->transactional(function (EntityManagerInterface $entityManager) use (
            $existingAttendees,
            $newAttendees
        ) {
            foreach ($existingAttendees as $existingAttendee) {
                $entityManager->remove($existingAttendee);
            }

            $entityManager->flush();

            $sequenceNumber = 0;

            foreach ($newAttendees as $newAttendee) {
                $newAttendee->updateSequenceNumber(++$sequenceNumber);
                $entityManager->persist($newAttendee);
            }
        });
    }
}
