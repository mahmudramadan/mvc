<?php
declare(strict_types=1);

namespace App\Controllers;

/**
 * PageNotFoundController
 *
 * @package App\Controllers
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 */
class PageNotFoundController extends Controller
{
    /**
     * show page not found
     */
    public function index(): void
    {
        $this->view->load("html", ["filePath" => "page404/index", "title" => "page not found."]);
    }
}
