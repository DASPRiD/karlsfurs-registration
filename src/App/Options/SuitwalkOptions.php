<?php
namespace App\Options;

use DateTime;
use Zend\Stdlib\AbstractOptions;

class SuitwalkOptions extends AbstractOptions
{
    /**
     * @var DateTime
     */
    private $nextDate;

    /**
     * @var DateTime
     */
    private $meetingTime;

    /**
     * @var DateTime
     */
    private $departureTime;

    /**
     * @var DateTime
     */
    private $returnTime;

    /**
     * @var DateTime
     */
    private $dinnerTime;

    /**
     * @var string
     */
    private $meetingPointAddress;

    /**
     * @var string
     */
    private $meetingPointEmbedUrl;

    /**
     * @var string
     */
    private $restaurantAddress;

    /**
     * @var string
     */
    private $restaurantEmbedUrl;

    /**
     * @var string
     */
    private $furbaseThreadUrl;

    /**
     * @var string
     */
    private $telegramGroupUrl;

    /**
     * @return DateTime
     */
    public function getNextDate()
    {
        return $this->nextDate;
    }

    /**
     * @return DateTime
     */
    public function getMeetingTime()
    {
        return $this->meetingTime;
    }

    /**
     * @return DateTime
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * @return DateTime
     */
    public function getReturnTime()
    {
        return $this->returnTime;
    }

    /**
     * @return DateTime
     */
    public function getDinnerTime()
    {
        return $this->dinnerTime;
    }

    /**
     * @return string
     */
    public function getMeetingPointAddress()
    {
        return $this->meetingPointAddress;
    }

    /**
     * @return string
     */
    public function getMeetingPointEmbedUrl()
    {
        return $this->meetingPointEmbedUrl;
    }

    /**
     * @return string
     */
    public function getRestaurantAddress()
    {
        return $this->restaurantAddress;
    }

    /**
     * @return string
     */
    public function getRestaurantEmbedUrl()
    {
        return $this->restaurantEmbedUrl;
    }

    /**
     * @return string
     */
    public function getFurbaseThreadUrl()
    {
        return $this->furbaseThreadUrl;
    }

    /**
     * @return string
     */
    public function getTelegramGroupUrl()
    {
        return $this->telegramGroupUrl;
    }

    /**
     * @param DateTime|string $nextDate
     */
    public function setNextDate($nextDate)
    {
        if (!$nextDate instanceof DateTime) {
            $nextDate = new DateTime($nextDate);
        }

        $this->nextDate = $nextDate;
    }

    /**
     * @param DateTime|string $meetingTime
     */
    public function setMeetingTime($meetingTime)
    {
        if (!$meetingTime instanceof DateTime) {
            $meetingTime = DateTime::createFromFormat('!H:i', $meetingTime);
        }

        $this->meetingTime = $meetingTime;
    }

    /**
     * @param DateTime|string $departureTime
     */
    public function setDepartureTime($departureTime)
    {
        if (!$departureTime instanceof DateTime) {
            $departureTime = DateTime::createFromFormat('!H:i', $departureTime);
        }

        $this->departureTime = $departureTime;
    }

    /**
     * @param DateTime|string $returnTime
     */
    public function setReturnTime($returnTime)
    {
        if (!$returnTime instanceof DateTime) {
            $returnTime = DateTime::createFromFormat('!H:i', $returnTime);
        }

        $this->returnTime = $returnTime;
    }

    /**
     * @param DateTime|string $dinnerTime
     */
    public function setDinnerTime($dinnerTime)
    {
        if (!$dinnerTime instanceof DateTime) {
            $dinnerTime = DateTime::createFromFormat('!H:i', $dinnerTime);
        }

        $this->dinnerTime = $dinnerTime;
    }

    /**
     * @param string $meetingPointAddress
     */
    public function setMeetingPointAddress($meetingPointAddress)
    {
        $this->meetingPointAddress = $meetingPointAddress;
    }

    /**
     * @param string $meetingPointEmbedUrl
     */
    public function setMeetingPointEmbedUrl($meetingPointEmbedUrl)
    {
        $this->meetingPointEmbedUrl = $meetingPointEmbedUrl;
    }

    /**
     * @param string $restaurantAddress
     */
    public function setRestaurantAddress($restaurantAddress)
    {
        $this->restaurantAddress = $restaurantAddress;
    }

    /**
     * @param string $restaurantEmbedUrl
     */
    public function setRestaurantEmbedUrl($restaurantEmbedUrl)
    {
        $this->restaurantEmbedUrl = $restaurantEmbedUrl;
    }

    /**
     * @param string $furbaseThreadUrl
     */
    public function setFurbaseThreadUrl($furbaseThreadUrl)
    {
        $this->furbaseThreadUrl = $furbaseThreadUrl;
    }

    /**
     * @param string $telegramGroupUrl
     */
    public function setTelegramGroupUrl($telegramGroupUrl)
    {
        $this->telegramGroupUrl = $telegramGroupUrl;
    }
}
