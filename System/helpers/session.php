<?php

function flash($message){
    $_SESSION['message'] = $message;
}

function has_message() {
    return isset($_SESSION['message']) ? true : false;
}

function get_message() {
   echo $_SESSION['message'];
   unset($_SESSION['message']);
}