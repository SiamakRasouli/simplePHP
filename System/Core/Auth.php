<?php

namespace System\Core;

class Auth
{

    static function check()
    {
        return isset($_SESSION['is_user']) ? TRUE : FALSE;
    }

    static function user($data = 'user_id'){
        return (object) $_SESSION['is_user'];
    }

    static function login($data, $url = '/dashboard')
    {
        $_SESSION['is_user']['user_id'] = $data[0]->id;
        $_SESSION['is_user']['user'] = $data[0]->user;
        $_SESSION['is_user']['email'] = $data[0]->email;
        $_SESSION['is_user']['mobile'] = $data[0]->mobile;

        return redirect($url);
    }

    static function logout($url = '/admin') {
        $_SESSION['is_user'] = array();
        session_unset();

        return redirect($url);
    }
}
