<?php

define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);

return [
    'dsn' => 'mysql:host=localhost',
    'charset' => 'charset=utf8',
    'dbname' => 'demo-dashboard',
    'user' => 'root',
    'pwd' => '',
    'options' =>  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
];