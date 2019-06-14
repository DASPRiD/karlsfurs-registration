<?php
return Zend\Stdlib\ArrayUtils::merge(
    (new DASPRiD\Helios\ConfigProvider())->__invoke(),
    [
        'dependencies' => [
            'invokables' => [
                Suitwalk\Infrastructure\Authentication\StringLookup::class =>
                    Suitwalk\Infrastructure\Authentication\StringLookup::class,
            ],
        ],

        'helios' => [
            'middleware' => [
                'identity_lookup_id' => Suitwalk\Infrastructure\Authentication\StringLookup::class,
            ],
        ],
    ]
);
