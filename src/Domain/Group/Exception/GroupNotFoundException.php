<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Group\Exception;

use OutOfBoundsException;

final class GroupNotFoundException extends OutOfBoundsException implements ExceptionInterface
{
    public static function fromNonExistentId(int $id) : self
    {
        return new self(sprintf('Group with ID %d could not be found', $id));
    }
}
