<?php
namespace App\Entity;

use DateTime;

class Attendee
{
    const STATUS_YES = 'yes';
    const STATUS_NO = 'no';
    const STATUS_MAYBE = 'maybe';

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
    private $walkStatus = self::STATUS_NO;

    /**
     * @var string
     */
    private $dinnerStatus = self::STATUS_NO;

    /**
     * @var DateTime
     */
    private $lastUpdateDateTime;

    /**
     * @param string $emailAddress
     */
    public function __construct($emailAddress)
    {
        $this->emailAddress = strtolower($emailAddress);
        $this->updateLastUpdateDateTime();
    }

    /**
     * @return Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getWalkStatus()
    {
        return $this->walkStatus;
    }

    /**
     * @return string
     */
    public function getDinnerStatus()
    {
        return $this->dinnerStatus;
    }

    /**
     * @return DateTime
     */
    public function getLastUpdateDateTime()
    {
        return $this->lastUpdateDateTime;
    }

    public function updateLastUpdateDateTime()
    {
        $this->lastUpdateDateTime = new DateTime();
    }
}
