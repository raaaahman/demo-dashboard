<?php
/**
 * Bootstrap connection to database
 */

require "helpers.php";
require "Connection.php";
require "DbQuery.php";
clearstatcache();
if (file_exists('database/config.php'))
    $config = require "config.php";
else
    $config = require "config.default.php";

$pdo = Connection::set($config);

return new DbQuery($pdo);