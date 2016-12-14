<?php
return [
    'dependencies' => [
        'factories' => [
            Suitwalk\Infrastructure\Middleware\Home::class =>
                Suitwalk\Factory\Infrastructure\Middleware\HomeFactory::class,
            Suitwalk\Infrastructure\Middleware\Login::class =>
                Suitwalk\Factory\Infrastructure\Middleware\LoginFactory::class,
            Suitwalk\Infrastructure\Middleware\Logout::class =>
                Suitwalk\Factory\Infrastructure\Middleware\LogoutFactory::class,
            Suitwalk\Infrastructure\Middleware\SetLocale::class =>
                Suitwalk\Factory\Infrastructure\Middleware\SetLocaleFactory::class,
            Suitwalk\Infrastructure\Middleware\Svg::class =>
                Suitwalk\Factory\Infrastructure\Middleware\SvgFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => Suitwalk\Infrastructure\Middleware\Home::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'login',
            'path' => '/login[/{token}]',
            'middleware' => Suitwalk\Infrastructure\Middleware\Login::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'logout',
            'path' => '/logout',
            'middleware' => Suitwalk\Infrastructure\Middleware\Logout::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'language',
            'path' => '/language/{locale:[a-z]{2}-[A-Z]{2}}',
            'middleware' => Suitwalk\Infrastructure\Middleware\SetLocale::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'svg',
            'path' => '/svg',
            'middleware' => Suitwalk\Infrastructure\Middleware\Svg::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
