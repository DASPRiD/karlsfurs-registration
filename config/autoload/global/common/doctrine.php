<?php
return [
    'dependencies' => [
        'factories' => [
            Doctrine\ORM\EntityManagerInterface::class => ContainerInteropDoctrine\EntityManagerFactory::class,
        ],
    ],

    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'driverOptions' => [
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    ],
                ],
            ],
        ],
        'driver' => [
            'orm_default' => [
                'drivers' => [
                    'Suitwalk\Domain' => 'common',
                ],
            ],
            'common' => [
                'class' => Doctrine\ORM\Mapping\Driver\XmlDriver::class,
                'cache' => 'array',
                'paths' => __DIR__ . '/../../../doctrine',
            ],
        ],
    ],
];
