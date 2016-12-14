<?php
return [
    'dependencies' => [
        'factories' => [
            Suitwalk\Infrastructure\Template\Extension\SuitwalkOptionsExtension::class =>
                Suitwalk\Factory\Infrastructure\Template\Extension\SuitwalkOptionsExtensionFactory::class,
            Suitwalk\Infrastructure\Template\Extension\TranslateExtension::class =>
                Suitwalk\Factory\Infrastructure\Template\Extension\TranslateExtensionFactory::class,
        ],
    ],

    'templates' => [
        'paths' => [
            'common' => ['templates/common'],
        ],
    ],

    'plates' => [
        'extensions' => [
            Suitwalk\Infrastructure\Template\Extension\SuitwalkOptionsExtension::class,
            Suitwalk\Infrastructure\Template\Extension\TranslateExtension::class,
        ],
    ],
];