<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Attendee;

interface ReplaceAttendeesInterface
{
    /**
     * @param Attendee[] $existingAttendees
     * @param Attendee[] $newAttendees
     */
    public function __invoke(array $existingAttendees, array $newAttendees);
}
