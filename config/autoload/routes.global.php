<?php
return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
            App\Action\PingAction::class => App\Action\PingAction::class,
        ],
        'factories' => [
            App\Action\HomePageAction::class => App\Action\HomePageActionFactory::class,
            App\Action\SvgAction::class => App\Action\SvgActionFactory::class,
            App\Action\LoginAction::class => App\Action\LoginActionFactory::class,
            App\Action\LogoutAction::class => App\Action\LogoutActionFactory::class,
            App\Action\LanguageAction::class => App\Action\LanguageActionFactory::class,
        ],
    ],
    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Action\HomePageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'svg',
            'path' => '/svg',
            'middleware' => App\Action\SvgAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'login',
            'path' => '/login',
            'middleware' => App\Action\LoginAction::class,
            'allowed_methods' => ['POST'],
        ],
        [
            'name' => 'login-confirm',
            'path' => '/login/{token}',
            'middleware' => App\Action\LoginAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'logout',
            'path' => '/logout',
            'middleware' => App\Action\LogoutAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'language',
            'path' => '/language/{locale}',
            'middleware' => App\Action\LanguageAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
