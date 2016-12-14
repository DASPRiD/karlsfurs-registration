<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Form;

use DASPRiD\Formidable\Form;
use DASPRiD\Formidable\FormInterface;
use DASPRiD\Formidable\Mapping\FieldMapping;
use DASPRiD\Formidable\Mapping\FieldMappingFactory;
use DASPRiD\Formidable\Mapping\ObjectMapping;
use DASPRiD\Formidable\Mapping\RepeatedMapping;
use Suitwalk\Domain\Attendee\Attendee;
use Suitwalk\Infrastructure\Form\Mapping\Constraint\HaystackConstraint;
use Suitwalk\Infrastructure\Form\Mapping\Formatter\GroupFormatter;

final class AttendeeFormBuilder
{
    /**
     * @var GroupFormatter
     */
    private $groupFormatter;

    public function __construct(GroupFormatter $groupFormatter)
    {
        $this->groupFormatter = $groupFormatter;
    }

    public function buildForm(string $emailAddress, array $groups) : FormInterface
    {
        $groupIds = [];

        foreach ($groups as $group) {
            $groupIds[] = (string) $group->getId();
        }

        $statusConstraint = new HaystackConstraint([
            Attendee::STATUS_YES,
            Attendee::STATUS_NO,
            Attendee::STATUS_MAYBE,
        ]);

        return new Form(new ObjectMapping([
            'attendees' => new RepeatedMapping(new ObjectMapping([
                'emailAddress' => FieldMappingFactory::ignored($emailAddress),
                'group' => new FieldMapping($this->groupFormatter),
                'name' => FieldMappingFactory::nonEmptyText(0, 32),
                'walkStatus' => FieldMappingFactory::text()->verifying($statusConstraint),
                'dinnerStatus' => FieldMappingFactory::text()->verifying($statusConstraint),
            ], Attendee::class)),
        ], AttendeeData::class));
    }
}
