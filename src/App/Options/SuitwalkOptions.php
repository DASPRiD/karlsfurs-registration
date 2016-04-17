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
