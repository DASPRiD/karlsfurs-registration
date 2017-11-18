<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Attendee;

use Suitwalk\Domain\Event\Event;

interface SearchAttendeesByEmailAddressInterface
{
    /**
     * @return Attendee[]
     */
    public function __invoke(Event $event, string $emailAddress) : array;
}
