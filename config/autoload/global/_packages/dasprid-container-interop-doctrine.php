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
                'class' => Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [],
            ],
        ],
        'types' => [
            VasekPurchart\Doctrine\Type\DateTimeImmutable\DateImmutableType::NAME =>
                VasekPurchart\Doctrine\Type\DateTimeImmutable\DateImmutableType::class,
            VasekPurchart\Doctrine\Type\DateTimeImmutable\DateTimeImmutableType::NAME =>
                VasekPurchart\Doctrine\Type\DateTimeImmutable\DateTimeImmutableType::class,
        ],
    ],
];
