<?php
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationConfigInjectionDelegator;

return [
    'dependencies' => [
        'delegators' => [
            Application::class => [
                ApplicationConfigInjectionDelegator::class,
            ],
        ],
    ],

     ConfigAggregator::ENABLE_CACHE => true,
    'debug' => false,

    'zend-expressive' => [
        'error_handler' => [
            'template_404'   => 'error::404',
            'template_error' => 'error::error',
        ],
    ],
];
