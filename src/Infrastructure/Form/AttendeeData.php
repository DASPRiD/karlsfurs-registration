<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Form;

use Suitwalk\Domain\Attendee\Attendee;

final class AttendeeData
{
    /**
     * @var Attendee[]
     */
    private $attendees;

    public function __construct(array $attendees)
    {
        $this->attendees = $attendees;
    }

    /**
     * @return Attendee[]
     */
    public function getAttendees() : array
    {
        return $this->attendees;
    }
}
