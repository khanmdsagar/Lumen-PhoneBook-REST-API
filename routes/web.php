<?php

$router->get('/', 'Controller@home');

$router->post('/insertData', 'Controller@insertData');

$router->get('/selectData', 'Controller@selectData');

$router->post('/updateData/{id}', 'Controller@updateData');

$router->post('/deleteData/{id}', 'Controller@deleteData');

$router->get('/searchData/{name}', 'Controller@searchData');

