<?php

use Core\Router;

$router = Router::getInstance();

$router->post('/api/registration', '\App\Controllers\AuthController@registration');
$router->post('/api/login', '\App\Controllers\AuthController@login');
