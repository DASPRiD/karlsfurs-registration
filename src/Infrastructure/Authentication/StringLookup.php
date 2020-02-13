<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Authentication;

use DASPRiD\Helios\Identity\IdentityLookupInterface;
use DASPRiD\Helios\Identity\LookupResult;

final class StringLookup implements IdentityLookupInterface
{
    public function lookup($subject) : LookupResult
    {
        if (is_string($subject)) {
            $emailAddress = $subject;
            $displayName = $emailAddress;
        } elseif (is_array($subject)) {
            $emailAddress = $subject['email_address'];
            $displayName = $subject['display_name'];
        } else {
            return LookupResult::invalid();
        }

        if (false === filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            return LookupResult::invalid();
        }

        return LookupResult::fromIdentity([
            'emailAddress' => $emailAddress,
            'displayName' => $displayName,
        ]);
    }
}
