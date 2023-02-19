<?php

function base_url($url = '') {
    global $base_url;
    return $base_url . $url;
}
function parseURI() {
    return explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
}