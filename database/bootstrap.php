<?php
/**
 * Created by PhpStorm.
 * User: sleuvin
 * Date: 12/07/18
 * Time: 07:22
 *
 * Bootstrap connection to database
 */

require "helpers.php";
require "Connection.php";
require "DbQuery.php";

$pdo = Connection::set();

return new DbQuery($pdo);