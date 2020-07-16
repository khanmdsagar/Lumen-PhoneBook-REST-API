<?php
$router->get('/', 'Controller@home');

$router->post('/onInsert', ['middleware' => 'auth', 'uses' => 'Controller@insertData']);

$router->post('/onSelect',  ['middleware' => 'auth', 'uses' => 'Controller@selectData']);

$router->post('/onUpdate', ['middleware' => 'auth', 'uses' => 'Controller@updateData']);

$router->post('/onDelete', ['middleware' => 'auth', 'uses' => 'Controller@deleteData']);

$router->post('/onSearch', ['middleware' => 'auth', 'uses' => 'Controller@searchData']);

$router->post('/onFileUpload', ['middleware' => 'auth', 'uses' => 'Controller@onFileUpload']);



//login & registration
$router->post('/onRegistration', 'registrationController@registration');

$router->post('/onLogin', 'loginController@login');

