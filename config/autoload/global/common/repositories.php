<?php
return [
    'dependencies' => [
        'factories' => [
            Suitwalk\Domain\Attendee\ReplaceAttendeesInterface::class =>
                Suitwalk\Factory\Infrastructure\Repository\Attendee\ReplaceAttendeesFactory::class,
            Suitwalk\Domain\Attendee\SearchAttendeesByEmailAddressInterface::class =>
                Suitwalk\Factory\Infrastructure\Repository\Attendee\SearchAttendeesByEmailAddressFactory::class,

            Suitwalk\Domain\Group\GetAllGroupsInterface::class =>
                Suitwalk\Factory\Infrastructure\Repository\Group\GetAllGroupsFactory::class,
            Suitwalk\Domain\Group\GetGroupByIdInterface::class =>
                Suitwalk\Factory\Infrastructure\Repository\Group\GetGroupByIdFactory::class,

            Suitwalk\Domain\Medium\GetAllMediaInterface::class =>
                Suitwalk\Factory\Infrastructure\Repository\Medium\GetAllMediaFactory::class,

            Suitwalk\Domain\Event\GetLatestEventInterface::class =>
                Suitwalk\Factory\Infrastructure\Repository\Event\GetLatestEventFactory::class,

            Suitwalk\Domain\History\GetHistoryInterface::class =>
                Suitwalk\Factory\Infrastructure\Repository\History\GetHistoryFactory::class,
        ],
    ],
];
