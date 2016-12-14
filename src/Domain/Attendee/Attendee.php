<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Attendee;

use DateTimeImmutable;
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

    public function __construct(
        string $emailAddress,
        Group $group,
        string $name,
        string $walkStatus,
        string $dinnerStatus
    ) {
        $this->emailAddress = $emailAddress;
        $this->group = $group;
        $this->name = $name;
        $this->walkStatus = $walkStatus;
        $this->dinnerStatus = $dinnerStatus;
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
