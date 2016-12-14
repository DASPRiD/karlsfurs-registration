<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Group;

interface GetAllGroupsInterface
{
    /**
     * @return Group[]
     */
    public function getAll() : array;
}
