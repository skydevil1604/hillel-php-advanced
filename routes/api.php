<?php

use Core\Router;

$router = Router::getInstance();

$router->post('/api/registration', '\App\Controllers\AuthController@registration');
$router->post('/api/login', '\App\Controllers\AuthController@login');
$router->get('/api/bookings', '\App\Controllers\BookingsController@index');
$router->get('/api/bookings/{id}', '\App\Controllers\BookingsController@show');
$router->post('/api/bookings/store', '\App\Controllers\BookingsController@store');
$router->put('/api/bookings/{id}/update', '\App\Controllers\BookingsController@update');
$router->delete('/api/bookings/{id}/delete', '\App\Controllers\BookingsController@destroy');
