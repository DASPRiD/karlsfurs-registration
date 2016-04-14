<?php
return [
    'dependencies' => [
        'factories' => [
            'doctrine.entity_manager.orm_default' => \ContainerInteropDoctrine\EntityManagerFactory::class,
        ],
    ],
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'driverOptions' => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                    ],
                ],
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => \Doctrine\ORM\Mapping\Driver\XmlDriver::class,
                'cache' => 'array',
                'paths' => __DIR__ . '/../doctrine',
            ],
        ],
    ],
];
