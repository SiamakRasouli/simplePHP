<?php
ob_start();
session_start();

use System\Core\Router;
use System\Core\Database;

require_once 'vendor/autoload.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    if(file_exists($class . '.class.php')) {
        include $class . '.class.php';
    } elseif(file_exists($class . '.php')) {
        include $class . '.php';
    }
});

require_once __DIR__ . '/App/Config.php';
require_once __DIR__ . '/System/helpers/load_helpers.php';

# New Database
$db = new Database();

# Load Router
$router = new Router();
$routes = require __DIR__ . '/App/routes.php';
$router->run();

?>