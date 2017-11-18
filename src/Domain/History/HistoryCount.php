<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\History;

use Suitwalk\Domain\Group\Group;

final class HistoryCount
{
    /**
     * @var Group
     */
    private $group;

    /**
     * @var int
     */
    private $count;

    public function __construct(Group $group, int $count)
    {
        $this->group = $group;
        $this->count = $count;
    }

    public function getGroup() : Group
    {
        return $this->group;
    }

    public function getCount() : int
    {
        return $this->count;
    }
}
