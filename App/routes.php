<?php

namespace App;

use App\Controllers\HomeController;

$router->get('/', [HomeController::class, 'index']);
$router->get('/test', [HomeController::class, 'test']);