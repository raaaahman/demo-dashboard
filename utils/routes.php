<?php

/*return [
    '' => [ 'controllers/users_list.php' ],
    'users-list' => [ 'controllers/users_list.php' ],
    'users-stats' => [ 'controllers/users_stats.php' ],
    'new-user' => [ 
        'controllers/user_form.php', 
        [ 
            'action' => 'create' 
        ]
    ],
    'update-user' => [
        'controllers/user_form.php',
        [
            'action' => 'update'
        ]
    ],
    'login' => 'LoginController@index'
];*/

$router->get('', 'LoginController');

$router->get('login', 'LoginController');

$router->get('sign-up', 'LoginController@newUser');

$router->post('register', 'LoginController@registerUser');