<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Event;

interface GetAllEventsInterface
{
    /**
     * @return Event[]
     */
    public function __invoke() : array;
}
