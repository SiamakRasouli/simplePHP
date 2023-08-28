<?php

function base_url($url = '') {
    return env('APP_URL') . $url;
}
function parseURI() {
    return explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
}
function redirect($url, $response_code = 301) {
    header("Location: " . base_url() . $url, true, $response_code);
    exit();
}