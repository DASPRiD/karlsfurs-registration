<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Form\Mapping\Formatter;

use DASPRiD\Formidable\Data;
use DASPRiD\Formidable\FormError\FormError;
use DASPRiD\Formidable\Mapping\BindResult;
use DASPRiD\Formidable\Mapping\Formatter\Exception\InvalidTypeException;
use DASPRiD\Formidable\Mapping\Formatter\FormatterInterface;
use Suitwalk\Domain\Group\GetGroupByIdInterface;
use Suitwalk\Domain\Group\Group;
use Suitwalk\Domain\Group\Exception\GroupNotFoundException;

final class GroupFormatter implements FormatterInterface
{
    /**
     * @var GetGroupByIdInterface
     */
    private $getGroupById;

    public function __construct(GetGroupByIdInterface $getGroupById)
    {
        $this->getGroupById = $getGroupById;
    }

    public function bind(string $key, Data $data) : BindResult
    {
        if (!$data->hasKey($key)) {
            return BindResult::fromFormErrors(new FormError(
                $key,
                'error.required'
            ));
        }

        $groupId = (int) $data->getValue($key);

        try {
            $group = $this->getGroupById->getById($groupId);
        } catch (GroupNotFoundException $e) {
            return BindResult::fromFormErrors(new FormError(
                $key,
                'error.non-existent-group',
                ['groupId' => $groupId]
            ));
        }

        return BindResult::fromValue($group);
    }

    public function unbind(string $key, $value) : Data
    {
        if (!$value instanceof Group) {
            throw InvalidTypeException::fromInvalidType($value, Group::class);
        }

        return Data::fromFlatArray([$key => (string) $value->getId()]);
    }
}
