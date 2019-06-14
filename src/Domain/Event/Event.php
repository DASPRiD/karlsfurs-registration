<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Event;

use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Suitwalk\Domain\Attendee\Attendee;
use Suitwalk\Domain\Medium\Medium;
use Suitwalk\Infrastructure\Middleware\MediaHandler;

final class Event
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * @var DateTimeImmutable
     */
    private $meetingTime;

    /**
     * @var DateTimeImmutable
     */
    private $departureTime;

    /**
     * @var DateTimeImmutable
     */
    private $returnTime;

    /**
     * @var DateTimeImmutable
     */
    private $dinnerTime;

    /**
     * @var string
     */
    private $meetingPointAddress;

    /**
     * @var string
     */
    private $meetingPointExtraEn;

    /**
     * @var string
     */
    private $meetingPointExtraDe;

    /**
     * @var string
     */
    private $restaurantAddress;

    /**
     * @var Attendee[]|Collection
     */
    private $attendees;

    /**
     * @var MediaHandler[]|Collection
     */
    private $media;

    private function __construct()
    {
    }

    public function getDate() : DateTimeImmutable
    {
        return $this->date;
    }

    public function getMeetingTime() : DateTimeImmutable
    {
        return $this->meetingTime;
    }

    public function getDepartureTime() : DateTimeImmutable
    {
        return $this->departureTime;
    }

    public function getReturnTime() : DateTimeImmutable
    {
        return $this->returnTime;
    }

    public function getDinnerTime() : DateTimeImmutable
    {
        return $this->dinnerTime;
    }

    public function getMeetingPointAddress() : string
    {
        return $this->meetingPointAddress;
    }

    public function getMeetingPointExtra(string $languageCode) : string
    {
        if ($languageCode === 'de') {
            return $this->meetingPointExtraDe;
        }

        return $this->meetingPointExtraEn;
    }

    public function getRestaurantAddress() : string
    {
        return $this->restaurantAddress;
    }

    /**
     * @return Attendee[]
     */
    public function getAttendees() : array
    {
        return iterator_to_array($this->attendees);
    }

    /**
     * @return Medium[]
     */
    public function getMedia() : array
    {
        return iterator_to_array($this->media);
    }
}
