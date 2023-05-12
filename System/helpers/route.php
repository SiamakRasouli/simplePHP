<?php

use System\Core\Router;

function route($name) {
    (new Router)->run($name);
}
