<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\NewsModel;

/**
 * HomeController
 *
 * @package App\Controllers
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 */
class HomeController extends Controller
{
    protected NewsModel $newsModel;

    public function __construct(NewsModel $newsModel)
    {
        parent::__construct();
        $this->newsModel = $newsModel;
    }

    /**
     * show all active news page
     */
    public function index()
    {
        $this->view->load("html", [
            'filePath' => 'home/index',
            'title' => "home page",
            "news" => $this->newsModel->getActiveNews()
        ]);
    }
}
