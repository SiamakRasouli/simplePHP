<?php

namespace App;

use App\Controllers\HomeController;
use System\Core\Router;
$router= new Router();

$router->get('/', [HomeController::class, 'index']);