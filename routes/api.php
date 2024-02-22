<?php

use Core\Router;

$router = Router::getInstance();

$router->get('/users', '\App\Controllers\UserController@index');
$router->get('/user/{id}', '\App\Controllers\UserController@show');
$router->post('/users', '\App\Controllers\UserController@store');
$router->put('/user/{id}', '\App\Controllers\UserController@edit');
$router->delete('/user/{id}', '\App\Controllers\UserController@destroy');