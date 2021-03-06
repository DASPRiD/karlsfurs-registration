<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Attendee;

use Darsyn\IP\Version\Multi;
use DateTimeImmutable;
use Suitwalk\Domain\Event\Event;
use Suitwalk\Domain\Group\Group;

final class Attendee
{
    const STATUS_YES = 'yes';
    const STATUS_NO = 'no';
    const STATUS_MAYBE = 'maybe';

    /**
     * @var int
     */
    private $sequenceNumber;

    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var Event
     */
    private $event;

    /**
     * @var Group
     */
    private $group;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $walkStatus;

    /**
     * @var string
     */
    private $dinnerStatus;

    /**
     * @var DateTimeImmutable
     */
    private $lastUpdateDateTime;

    /**
     * @var Multi|null
     */
    private $ipAddress;

    public function __construct(
        string $emailAddress,
        Event $event,
        Group $group,
        string $name,
        string $walkStatus,
        string $dinnerStatus,
        Multi $ipAddress
    ) {
        $this->emailAddress = $emailAddress;
        $this->event = $event;
        $this->group = $group;
        $this->name = $name;
        $this->walkStatus = $walkStatus;
        $this->dinnerStatus = $dinnerStatus;
        $this->ipAddress = $ipAddress;
        $this->updateLastUpdateDateTime();
    }

    public function getGroup() : Group
    {
        return $this->group;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getWalkStatus() : string
    {
        return $this->walkStatus;
    }

    public function getDinnerStatus() : string
    {
        return $this->dinnerStatus;
    }

    public function getIpAddress() : ?Multi
    {
        return $this->ipAddress;
    }

    public function getLastUpdateDateTime() : DateTimeImmutable
    {
        return $this->lastUpdateDateTime;
    }

    public function updateLastUpdateDateTime()
    {
        $this->lastUpdateDateTime = new DateTimeImmutable();
    }

    public function updateSequenceNumber(int $sequenceNumber)
    {
        $this->sequenceNumber = $sequenceNumber;
    }
}
