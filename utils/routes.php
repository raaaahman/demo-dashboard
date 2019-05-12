<?php

$router->get('/', 'UsersController');

$router->get('/login', 'UsersController@authenticateUser');

$router->get('/logout', 'UsersController@logOutUser');

$router->get('/sign-up', 'UsersController@newUser');

$router->post('/register', 'UsersController@registerUser');

$router->get('/users-list', 'UsersController');

$router->get( '/edit-user', 'UsersController@editUser');

$router->post('/update-user', 'UsersController@updateUser');