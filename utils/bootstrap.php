<?php
/**
 * Bootstrap connection to database
 */

require "database/helpers.php";
require "database/Connection.php";
require "database/DbQuery.php";
require "utils/Router.php";
require "utils/routes.php";

if (file_exists('database/config.php'))
    $config = require "database/config.php";
else
    $config = require "database/config.default.php";

$pdo = Connection::set($config);

return new DbQuery($pdo);
