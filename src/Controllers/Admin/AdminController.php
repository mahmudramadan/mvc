<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\Controller;

/**
 * AdminController
 *
 * @package App\Controllers\Admin
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 */
class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['isLogged'])) {
            header("Location: " . BASE_URL . "login");
        }
    }
}
