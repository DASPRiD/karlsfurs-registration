<?php
use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

$cacheConfig = [
    'config_cache_path' => 'data/cache/config-cache.php',
];

$aggregator = new ConfigAggregator([
    \Zend\Expressive\Plates\ConfigProvider::class,
    \Zend\Expressive\Helper\ConfigProvider::class,
    \Zend\Expressive\Router\FastRouteRouter\ConfigProvider::class,
    \Zend\Expressive\ConfigProvider::class,
    \Zend\HttpHandlerRunner\ConfigProvider::class,
    \Zend\Expressive\Router\ConfigProvider::class,
    \DASPRiD\Pikkuleipa\ConfigProvider::class,
    \DASPRiD\Helios\ConfigProvider::class,
    new ArrayProvider($cacheConfig),
    new PhpFileProvider('config/autoload/{global,local}/{.,*,*/*}/*.php'),
    new PhpFileProvider('config/development.config.php'),
], 'disable' === getenv('CONFIG_CACHE', true) ? null : $cacheConfig['config_cache_path']);

return $aggregator->getMergedConfig();
