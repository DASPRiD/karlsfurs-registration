<?php
if (php_sapi_name() === 'cli-server'
    && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
) {
    return false;
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$container = require 'config/container.php';
$app = $container->get(\Zend\Expressive\Application::class);
$app->run();
