<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Event;

interface GetLatestEventInterface
{
    /**
     * @return Event
     */
    public function __invoke() : Event;
}
