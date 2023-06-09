<?php

namespace App;

use App\Controllers\HomeController;

$router->get('/', [HomeController::class, 'index'])->name('home');