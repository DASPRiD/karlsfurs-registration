<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Medium;

interface GetAllMediaInterface
{
    /**
     * @return Medium[]
     */
    public function __invoke() : array;
}
