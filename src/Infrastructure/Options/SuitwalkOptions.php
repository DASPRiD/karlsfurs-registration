<?php
namespace Suitwalk\Infrastructure\Options;

use DateTimeImmutable;

final class SuitwalkOptions
{
    /**
     * @var DateTimeImmutable
     */
    private $nextDate;

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
    private $meetingPointEmbedUrl;

    /**
     * @var string[]
     */
    private $meetingPointAdditionalInformation;

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

    public function __construct(
        DateTimeImmutable $nextDate,
        DateTimeImmutable $meetingTime,
        DateTimeImmutable $departureTime,
        DateTimeImmutable $returnTime,
        DateTimeImmutable $dinnerTime,
        string $meetingPointAddress,
        string $meetingPointEmbedUrl,
        array $meetingPointAdditionalInformation,
        string $restaurantAddress,
        string $restaurantEmbedUrl,
        string $furbaseThreadUrl,
        string $telegramGroupUrl
    ) {
        $this->nextDate = $nextDate;
        $this->meetingTime = $meetingTime;
        $this->departureTime = $departureTime;
        $this->returnTime = $returnTime;
        $this->dinnerTime = $dinnerTime;
        $this->meetingPointAddress = $meetingPointAddress;
        $this->meetingPointEmbedUrl = $meetingPointEmbedUrl;
        $this->meetingPointAdditionalInformation = $meetingPointAdditionalInformation;
        $this->restaurantAddress = $restaurantAddress;
        $this->restaurantEmbedUrl = $restaurantEmbedUrl;
        $this->furbaseThreadUrl = $furbaseThreadUrl;
        $this->telegramGroupUrl = $telegramGroupUrl;
    }

    public function getNextDate() : DateTimeImmutable
    {
        return $this->nextDate;
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

    public function getMeetingPointEmbedUrl() : string
    {
        return $this->meetingPointEmbedUrl;
    }

    public function getMeetingPointAdditionalInformation(string $languageCode) : string
    {
        return $this->meetingPointAdditionalInformation[$languageCode];
    }

    public function getRestaurantAddress() : string
    {
        return $this->restaurantAddress;
    }

    public function getRestaurantEmbedUrl() : string
    {
        return $this->restaurantEmbedUrl;
    }

    public function getFurbaseThreadUrl() : string
    {
        return $this->furbaseThreadUrl;
    }

    public function getTelegramGroupUrl() : string
    {
        return $this->telegramGroupUrl;
    }
}
