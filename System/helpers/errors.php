<?php

function abort($error = '404', $path = 'errors/404') {
    include 'App/Views/' . $path . '.php';
    http_response_code($error);
    exit;
}