<?php
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;

return [
    'dependencies' => [
        'factories' => [
            Helper\ServerUrlMiddleware::class => Helper\ServerUrlMiddlewareFactory::class,
            Helper\UrlHelperMiddleware::class => Helper\UrlHelperMiddlewareFactory::class,
        ],
    ],

    'middleware_pipeline' => [
        'always' => [
            'middleware' => [
                Helper\ServerUrlMiddleware::class,
                Suitwalk\Infrastructure\Middleware\LocaleDetection::class,
            ],
            'priority' => 10000,
        ],

        'routing' => [
            'middleware' => [
                ApplicationFactory::ROUTING_MIDDLEWARE,
                Helper\UrlHelperMiddleware::class,
            ],
            'priority' => 500,
        ],

        'authentication' => [
            'middleware' => [
                DASPRiD\Helios\IdentityMiddleware::class,
            ],
            'priority' => 250,
        ],

        'dispatch' => [
            'middleware' => [
                ApplicationFactory::DISPATCH_MIDDLEWARE,
            ],
            'priority' => 1,
        ],

        'error' => [
            'middleware' => [
            ],
            'error'    => true,
            'priority' => -10000,
        ],
    ],
];
