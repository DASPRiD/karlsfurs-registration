<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Group;

use Traversable;

final class Group
{
    /**
     * @var int
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

    private function __construct()
    {
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return Attendee[]
     */
    public function getAttendees() : Traversable
    {
        return $this->attendees;
    }
}
