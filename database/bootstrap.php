<?php
/**
 * Bootstrap connection to database
 */

require "helpers.php";
require "Connection.php";
require "DbQuery.php";
if (file_exists('config.php'))
    $config = require "config.php";
else
    $config = require "config.default.php";

$pdo = Connection::set($config);

return new DbQuery($pdo);