<?php

namespace App\Controllers;

use System\Core\Controller;

class HomeController extends Controller {

    function __construct()
    {
    }

    function index() {
        echo view('home');
    }
}