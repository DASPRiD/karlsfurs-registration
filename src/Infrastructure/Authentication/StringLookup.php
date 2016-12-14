<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Authentication;

use DASPRiD\Helios\Identity\IdentityLookupInterface;
use DASPRiD\Helios\Identity\LookupResult;

final class StringLookup implements IdentityLookupInterface
{
    public function lookup($subject) : LookupResult
    {
        return LookupResult::fromIdentity((string) $subject);
    }
}
