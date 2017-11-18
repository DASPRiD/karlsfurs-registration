<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\History;

use DateTimeImmutable;

final class HistoryEvent
{
    /**
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * @var HistoryCount[]
     */
    private $counts;

    /**
     * @param HistoryCount[] $counts
     */
    public function __construct(DateTimeImmutable $date, array $counts)
    {
        $this->date = $date;
        $this->counts = $counts;
    }

    public function getDate() : DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return HistoryCount[]
     */
    public function getCounts() : array
    {
        return $this->counts;
    }
}
