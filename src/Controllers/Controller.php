<?php

namespace App\Controllers;

use App\Output\ViewFactory;
use App\Output\ViewStrategy;

/**
 * Controller
 *
 * @package App\Controllers
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 */
abstract class Controller
{
    use ResponseMessage;

    public function __construct()
    {
        $this->generateCsrfToken();
    }

    /**
     * generate csrf token
     */
    private function generateCsrfToken(): void
    {
        $_SESSION['token'] = $_SESSION['token'] ?? bin2hex(random_bytes(32));
    }

    /**
     * load view htm, json...etc
     * @param string $type
     * @param array $data
     */
    public function view(string $type, array $data = []): void
    {
        $view = ViewFactory::initialize($type);
        $viewStrategy = new ViewStrategy($view);
        $viewStrategy->load($data);
    }
}
