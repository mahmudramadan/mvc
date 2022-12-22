<?php

namespace App\Controllers;

use App\Models\NewsModel;

class HomeController extends Controller
{
    protected NewsModel $model;

    public function __construct(NewsModel $newsModel)
    {
        parent::__construct();
        $this->model = $newsModel;
    }

    public function index()
    {
        $data = ['title' => "home page", "news" => $this->model->getActiveNews()];
        $this->view("home/index", $data);
    }
}

