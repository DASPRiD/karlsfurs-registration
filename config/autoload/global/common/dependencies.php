<?php
return [
    'dependencies' => [
        'factories' => [
            Suitwalk\Infrastructure\Options\SuitwalkOptions::class =>
                Suitwalk\Factory\Infrastructure\Options\SuitwalkOptionsFactory::class,

            Suitwalk\Infrastructure\Response\HtmlResponseRenderer::class =>
                Suitwalk\Factory\Infrastructure\Response\HtmlResponseRendererFactory::class,
        ],
    ],
];
