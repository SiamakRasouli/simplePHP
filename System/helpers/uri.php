<?php

function base_url($url = '') {
    return env('APP_URL') . $url;
}
function parseURI() {
    return explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
}