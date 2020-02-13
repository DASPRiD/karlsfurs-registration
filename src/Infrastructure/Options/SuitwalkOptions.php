<?php
namespace Suitwalk\Infrastructure\Options;

final class SuitwalkOptions
{
    /**
     * @var string
     */
    private $telegramBotName;

    /**
     * @var string
     */
    private $telegramBotToken;

    /**
     * @var string
     */
    private $oauthClientId;

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

    public function __construct(
        string $telegramBotName,
        string $telegramBotToken,
        string $oauthClientId,
        string $mapsApiKey,
        string $furbaseThreadUrl,
        string $telegramGroupUrl
    ) {
        $this->telegramBotName = $telegramBotName;
        $this->telegramBotToken = $telegramBotToken;
        $this->oauthClientId = $oauthClientId;
        $this->mapsApiKey = $mapsApiKey;
        $this->furbaseThreadUrl = $furbaseThreadUrl;
        $this->telegramGroupUrl = $telegramGroupUrl;
    }

    public function getTelegramBotName() : string
    {
        return $this->telegramBotName;
    }

    public function getTelegramBotToken() : string
    {
        return $this->telegramBotToken;
    }

    public function getOauthClientId() : string
    {
        return $this->oauthClientId;
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
