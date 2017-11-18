<?php
namespace Suitwalk\Infrastructure\Options;

final class SuitwalkOptions
{
    /**
     * @var string
     */
    private $mapsApiKey;

    /**
     * @var string
     */
    private $furbaseThreadUrl;

    /**
     * @var string
     */
    private $telegramGroupUrl;

    public function __construct(string $mapsApiKey, string $furbaseThreadUrl, string $telegramGroupUrl)
    {
        $this->mapsApiKey = $mapsApiKey;
        $this->furbaseThreadUrl = $furbaseThreadUrl;
        $this->telegramGroupUrl = $telegramGroupUrl;
    }

    public function getMapsApiKey() : string
    {
        return $this->mapsApiKey;
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
