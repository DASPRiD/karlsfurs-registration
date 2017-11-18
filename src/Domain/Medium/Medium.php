<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Medium;

use Suitwalk\Domain\Event\Event;

final class Medium
{
    const TYPE_GALLERY = 'gallery';
    const TYPE_VIDEO = 'video';

    /**
     * @var int
     */
    private $id;

    /**
     * @var Event
     */
    private $event;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $url;

    private function __construct()
    {
    }

    public function getEvent() : Event
    {
        return $this->event;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getUrl() : string
    {
        return $this->url;
    }
}
