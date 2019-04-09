<?php

$router->get('/', 'UsersController');

$router->get('/login', 'UsersController@authenticateUser');

$router->get('/sign-up', 'UsersController@newUser');

$router->post('/register', 'UserController@registerUser');

$router->get('/users-list', 'UsersController');