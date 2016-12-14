<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Attendee;

interface ReplaceAttendeesInterface
{
    /**
     * @param Attendees[] $existingAttendees
     * @param Attendees[] $newAttendees
     */
    public function replaceAttendees(array $existingAttendees, array $newAttendees);
}
