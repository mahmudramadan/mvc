<?php

declare(strict_types=1);
namespace App\Controllers;

class PageNotFoundController extends \App\Controllers\Controller
{
    public function index()
    {
        $data = ['title' => "page not found."];
        $this->view("page404/index", $data);
    }
}
