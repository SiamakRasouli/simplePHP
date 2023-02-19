<?php

function dd($value)
{
    echo '<pre style="background: rgba(10,20,30,1); padding: 1rem; color: white; border-radius: 0.5rem;">';
    var_dump($value);
    echo '</pre>';
    die();
}

function dump($value) {
    echo '<pre style="background: rgba(10,20,30,1); padding: 1rem; color: white; border-radius: 0.5rem;">';
    var_dump($value);
    echo '</pre>';
}

function base_path($path = '') {
    return $_SERVER['DOCUMENT_ROOT'] . $path;
}