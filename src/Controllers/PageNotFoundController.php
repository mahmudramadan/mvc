<?php

namespace App\Controllers;

class PageNotFoundController extends Controller
{
    public function index()
    {
        $data = ['title' => "page not found."];
        $this->view("page404/index", $data);
    }
}
