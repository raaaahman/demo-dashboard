<?php
/**
 * Bootstrap our application
 */

define('SITE_ROOT', dirname( __FILE__ ) . '/');
define('CTRL_DIR', SITE_ROOT . 'controllers/');
define('DB_DIR', SITE_ROOT . 'database/');
define('UTIL_DIR', SITE_ROOT . 'utils/');

require "database/helpers.php";
require DB_DIR . 'Connection.php';
require DB_DIR . 'DbQuery.php';
require CTRL_DIR . 'abstract-controller.php';

if (file_exists('config.php'))
    $config = require SITE_ROOT . 'config.php';
else
    $config = require SITE_ROOT . 'config.default.php';

$pdo = Connection::set($config);

return new DbQuery($pdo);
