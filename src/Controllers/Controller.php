<?php

namespace App\Controllers;

use App\Output\View;

/**
 * Controller
 *
 * @package App\Controllers
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 */
abstract class Controller
{
    use ResponseMessage;

    public View $view;

    public function __construct()
    {
        $this->view = new View();
        $this->generateCsrfToken();
    }

    /**
     * generate csrf token
     */
    private function generateCsrfToken(): void
    {
        $_SESSION['token'] = $_SESSION['token'] ?? bin2hex(random_bytes(32));
    }
}
