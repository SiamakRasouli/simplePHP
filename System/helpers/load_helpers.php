<?php

$global_helpers = ['errors', 'view', 'env', 'debug','uri'];

$helpers = array_merge($helpers, $global_helpers);
foreach($helpers as $helper) {
    include $helper . '.php';
}