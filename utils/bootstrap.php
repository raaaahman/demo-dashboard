<?php
/**
 * Bootstrap connection to database
 */

require "database/helpers.php";
require "database/Connection.php";
require "database/DbQuery.php";
require "controllers/abstract-controller.php";

if (file_exists('config.php'))
    $config = require 'config.php';
else
    $config = require 'config.default.php';

$pdo = Connection::set($config);

return new DbQuery($pdo);
