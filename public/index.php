<?php

use Core\Router;

define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . '/vendor/autoload.php';

$router = Router::getInstance();

try {
    die($router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']));
} catch (Exception $exception) {
    dd($exception);
}