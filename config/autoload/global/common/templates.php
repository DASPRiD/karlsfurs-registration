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
        'extension' => 'phtml',
        'paths' => [
            'layout' => ['templates/layout'],
            'error' => ['templates/error'],
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
