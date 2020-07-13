<?php
$router->get('/', 'Controller@home');

$router->post('/insertData', ['middleware' => 'auth', 'uses' => 'Controller@insertData']);

$router->post('/selectData',  ['middleware' => 'auth', 'uses' => 'Controller@selectData']);

$router->post('/updateData', ['middleware' => 'auth', 'uses' => 'Controller@updateData']);

$router->post('/deleteData', ['middleware' => 'auth', 'uses' => 'Controller@deleteData']);

$router->post('/searchData', ['middleware' => 'auth', 'uses' => 'Controller@searchData']);



//login & registration
$router->post('/registration', 'registrationController@registration');

$router->post('/login', 'loginController@login');

