<?php

$router->get('', 'LoginController');

$router->get('login', 'LoginController');

$router->post( 'authenticate', 'LoginController@verify');

$router->get('sign-up', 'LoginController@newUser');

$router->post('register', 'LoginController@registerUser');

$router->get('users-list', 'UsersController');