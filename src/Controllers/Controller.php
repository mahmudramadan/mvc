<?php
declare(strict_types=1);

namespace App\Controllers;

abstract class Controller
{
    final public function view(string $filePath, array $data)
    {
        require __DIR__ . "/../../src/views/main_layout.php";
    }
}
