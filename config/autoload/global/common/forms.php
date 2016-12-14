<?php
return [
    'dependencies' => [
        'factories' => [
            Suitwalk\Infrastructure\Form\Mapping\Formatter\GroupFormatter::class =>
                Suitwalk\Factory\Infrastructure\Form\Mapping\Formatter\GroupFormatterFactory::class,

            Suitwalk\Infrastructure\Form\AttendeeFormBuilder::class =>
                Suitwalk\Factory\Infrastructure\Form\AttendeeFormBuilderFactory::class,
        ],
    ],
];
