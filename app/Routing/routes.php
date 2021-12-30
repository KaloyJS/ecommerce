<?php

$router = new AltoRouter();

$router->map('GET', '/', 'App\Controllers\IndexController@show', 'home');

//admin routes 
$router->map('GET', '/admin', 'App\Controllers\Admin\DashboardController@show', 'admin_dashboard');
$router->map('POST', '/admin', 'App\Controllers\Admin\DashboardController@get', 'admin_form');