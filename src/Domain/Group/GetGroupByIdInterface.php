<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Group;

use Suitwalk\Domain\Group\Exception\GroupNotFoundException;

interface GetGroupByIdInterface
{
    /**
     * @throws GroupNotFoundException
     */
    public function getById(int $groupId) : Group;
}
