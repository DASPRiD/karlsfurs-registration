<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Form\Mapping\Constraint;

use DASPRiD\Formidable\Mapping\Constraint\ConstraintInterface;
use DASPRiD\Formidable\Mapping\Constraint\Exception\InvalidTypeException;
use DASPRiD\Formidable\Mapping\Constraint\ValidationError;
use DASPRiD\Formidable\Mapping\Constraint\ValidationResult;

class HaystackConstraint implements ConstraintInterface
{
    /**
     * @var array
     */
    private $haystack;

    public function __construct(array $haystack)
    {
        $this->haystack = $haystack;
    }

    public function __invoke($value) : ValidationResult
    {
        if (!is_string($value)) {
            throw InvalidTypeException::fromInvalidType($value, 'string');
        }

        if (!in_array($value, $this->haystack, true)) {
            return new ValidationResult(new ValidationError('error.haystack'));
        }

        return new ValidationResult();
    }
}
