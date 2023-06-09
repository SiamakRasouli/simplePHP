<?php

use System\Core\Router;

function route($name)
{
    $router = new Router();
    require base_path() . '\APP\routes.php';
    return base_url() . $router->get_uri($name);
}
