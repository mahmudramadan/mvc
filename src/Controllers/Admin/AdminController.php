<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;

class AdminController extends Controller
{

    public function __construct()
    {
        if (!isset($_SESSION['isLogged'])) {
            header("Location: " . BASE_URL . "login");
        }
    }

}
