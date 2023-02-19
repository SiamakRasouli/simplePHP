<?php

use System\Core\DotEnv;

function load_env() : void
{
    $env = new DotEnv();
    $env->load(__DIR__ . '/.env');
}
function env($env) : string
{
    load_env();
    return $_ENV[$env];
}
