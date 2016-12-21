<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Authentication;

use DASPRiD\Helios\Identity\IdentityLookupInterface;
use DASPRiD\Helios\Identity\LookupResult;

final class StringLookup implements IdentityLookupInterface
{
    public function lookup($subject) : LookupResult
    {
        if (!is_string($subject) || false === filter_var($subject, FILTER_VALIDATE_EMAIL)) {
            return LookupResult::invalid();
        }

        return LookupResult::fromIdentity($subject);
    }
}
