<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Medium;

use DateTimeImmutable;

final class Medium
{
    const TYPE_GALLERY = 'gallery';
    const TYPE_VIDEO = 'video';

    /**
     * @var int
     */
    private $id;

    /**
     * @var DateTimeImmutable
     */
    private $date;

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

    public function getDate() : DateTimeImmutable
    {
        return $this->date;
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
