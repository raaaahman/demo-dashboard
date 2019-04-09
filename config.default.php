<?php

define('SITE_URL', 'example.com');
define('SITE_SALT', '1234');

return [
    'dsn' => 'mysql:host=localhost',
    'charset' => 'charset=utf8',
    'dbname' => 'demo-dashboard',
    'user' => 'root',
    'pwd' => '',
    'options' =>  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
];