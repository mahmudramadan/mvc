<?php

use App\Controllers\Admin\NewsController;
use App\Controllers\Admin\AuthController;
use App\Controllers\HomeController;
use App\Controllers\PageNotFoundController;

return [
    '' => ["get", HomeController::class, "index"],
    'home' => ["get", HomeController::class, "index"],
    'login' => ["get", AuthController::class, "index"],
    'login-user' => ["post", AuthController::class, "loginUser"],
    'logout-user' => ["get", AuthController::class, "logoutUser"],
    'admin-page' => ["get", NewsController::class, "index"],
    'delete-news-item' => ["delete", NewsController::class, "delete"],
    'add-news-item' => ["post", NewsController::class, "add"],
    'edit-news' => ["get", NewsController::class, "edit"],
    'update-news-item' => ["post", NewsController::class, "update"],
    '404' => ["get", PageNotFoundController::class, "index"]
];
