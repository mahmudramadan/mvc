<?php

namespace App\Controllers;

use App\Traits\JsonResponse;

abstract class Controller
{
    use JsonResponse;
    public function __construct()
    {
        $this->generateCsrfToken();
    }

    public function generateCsrfToken()
    {
        $_SESSION['token'] = $_SESSION['token'] ?? bin2hex(random_bytes(32));
    }


    final public function view(string $filePath, array $data)
    {
        require __DIR__ . "/../../src/views/main_layout.php";
    }
}
