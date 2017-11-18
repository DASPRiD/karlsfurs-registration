<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\History;

interface GetHistoryInterface
{
    /**
     * @param Group[] $groups
     * @return HistoryEvent[]
     */
    public function __invoke(array $groups) : array;
}
