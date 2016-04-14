<?php
namespace App\Entity;

use DomainException;

class Group
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var int
     */
    private $priority;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Attendee[]
     */
    private $attendees;

    /**
     * @return int
     * @throws DomainException
     */
    public function getId()
    {
        if (null === $this->id) {
            throw new DomainException('Attendee has not been persisted');
        }

        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Attendee[]
     */
    public function getAttendees()
    {
        return $this->attendees;
    }
}
