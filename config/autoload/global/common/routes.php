<?php
return [
    'dependencies' => [
        'factories' => [
            Suitwalk\Infrastructure\Handler\HomeHandler::class =>
                Suitwalk\Factory\Infrastructure\Handler\HomeHandlerFactory::class,
            Suitwalk\Infrastructure\Handler\LoginHandler::class =>
                Suitwalk\Factory\Infrastructure\Handler\LoginHandlerFactory::class,
            Suitwalk\Infrastructure\Handler\LogoutHandler::class =>
                Suitwalk\Factory\Infrastructure\Handler\LogoutHandlerFactory::class,
            Suitwalk\Infrastructure\Handler\SetLocaleHandler::class =>
                Suitwalk\Factory\Infrastructure\Handler\SetLocaleHandlerFactory::class,
            Suitwalk\Infrastructure\Handler\MediaHandler::class =>
                Suitwalk\Factory\Infrastructure\Handler\MediaHandlerFactory::class,
            Suitwalk\Infrastructure\Handler\HistoryHandler::class =>
                Suitwalk\Factory\Infrastructure\Handler\HistoryHandlerFactory::class,
            Suitwalk\Infrastructure\Handler\ICalHandler::class =>
                Suitwalk\Factory\Infrastructure\Handler\ICalHandlerFactory::class,
            Suitwalk\Infrastructure\Handler\SvgHandler::class =>
                Suitwalk\Factory\Infrastructure\Handler\SvgHandlerFactory::class,
            Suitwalk\Infrastructure\Handler\TokenSigninHandler::class =>
                Suitwalk\Factory\Infrastructure\Handler\TokenSigninHandlerFactory::class,
            Suitwalk\Infrastructure\Handler\TelegramSigninHandler::class =>
                Suitwalk\Factory\Infrastructure\Handler\TelegramSigninHandlerFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => Suitwalk\Infrastructure\Handler\HomeHandler::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'login',
            'path' => '/login[/{token}]',
            'middleware' => Suitwalk\Infrastructure\Handler\LoginHandler::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'token-signin',
            'path' => '/token-signin',
            'middleware' => Suitwalk\Infrastructure\Handler\TokenSigninHandler::class,
            'allowed_methods' => ['POST'],
        ],
        [
            'name' => 'telegram-signin',
            'path' => '/telegram-signin',
            'middleware' => Suitwalk\Infrastructure\Handler\TelegramSigninHandler::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'logout',
            'path' => '/logout',
            'middleware' => Suitwalk\Infrastructure\Handler\LogoutHandler::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'language',
            'path' => '/language/{locale:[a-z]{2}-[A-Z]{2}}',
            'middleware' => Suitwalk\Infrastructure\Handler\SetLocaleHandler::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'media',
            'path' => '/media',
            'middleware' => Suitwalk\Infrastructure\Handler\MediaHandler::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'history',
            'path' => '/history',
            'middleware' => Suitwalk\Infrastructure\Handler\HistoryHandler::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'ical',
            'path' => '/ical',
            'middleware' => Suitwalk\Infrastructure\Handler\ICalHandler::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'svg',
            'path' => '/svg',
            'middleware' => Suitwalk\Infrastructure\Handler\SvgHandler::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
