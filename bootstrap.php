<?php
/**
 * Bootstrap our application
 */

define('SITE_ROOT', dirname( __FILE__ ) . '/');
define('CTRL_DIR', SITE_ROOT . 'controllers/');
define('DB_DIR', SITE_ROOT . 'database/');
define('UTIL_DIR', SITE_ROOT . 'utils/');

if (file_exists('config.php'))
    $config = require SITE_ROOT . 'config.php';
else
    $config = require SITE_ROOT . 'config.default.php';

require "database/helpers.php";
require DB_DIR . 'Connection.php';
require DB_DIR . 'DbQuery.php';
require CTRL_DIR . 'AbstractController.php';
require UTIL_DIR . 'LoginManager.php';
require UTIL_DIR . 'Router.php';

//Instanciation d'un routeur et chargement des routes
$router = new Router();
require UTIL_DIR . 'routes.php';

$pdo = Connection::set($config);

$db = new DbQuery($pdo);
