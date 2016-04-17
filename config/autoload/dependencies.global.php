<?php
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;

return [
    'dependencies' => [
        'invokables' => [
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
        ],
        'factories' => [
            Application::class => ApplicationFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
            App\Repository\GroupRepository::class => App\Repository\GroupRepositoryFactory::class,
            App\Repository\AttendeeRepository::class => App\Repository\AttendeeRepositoryFactory::class,
            App\Helper\LoginHelper::class => App\Helper\LoginHelperFactory::class,
            App\Options\SuitwalkOptions::class => App\Options\SuitwalkOptionsFactory::class,
        ],
    ],
];
