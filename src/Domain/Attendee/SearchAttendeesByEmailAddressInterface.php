<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Attendee;

interface SearchAttendeesByEmailAddressInterface
{
    /**
     * @return Attendee[]
     */
    public function searchByEmailAddress(string $emailAddress) : array;
}
