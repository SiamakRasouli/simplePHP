<?php

use System\Core\Router;
use System\Core\Database;

spl_autoload_register(function ($class) {
    if(file_exists($class . '.class.php')) {
        include $class . '.class.php';
    } elseif(file_exists($class . '.php')) {
        include $class . '.php';
    }
});

require_once __DIR__ . '\App\Config.php';
require_once __DIR__ . '\System\helpers\load_helpers.php';

# New Database
$db = new Database();

# Load Router
$router = new Router();
$routes = require __DIR__ . '\App\routes.php';
$router->run();

?>