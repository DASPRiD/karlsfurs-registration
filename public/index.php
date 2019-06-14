<?php
declare(strict_types = 1);

if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

(function () {
    $container = require 'config/container.php';
    $app = $container->get(\Zend\Expressive\Application::class);

    (require 'config/pipeline.php')($app);

    $app->run();
})();
