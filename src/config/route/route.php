<?php

use App\Controllers\Admin\News\NewsController;
use App\Controllers\Admin\AuthController;
use App\Controllers\HomeController;
use App\Controllers\PageNotFoundController;

return [
    '' => ["requestMethod" => "get", "controllerClass" => HomeController::class, "methodName" => "index"],
    'home' => ["requestMethod" => "get", "controllerClass" => HomeController::class, "methodName" => "index"],
    'login' => ["requestMethod" => "get", "controllerClass" => AuthController::class, "methodName" => "index"],
    'login-user' => ["requestMethod" => "post", "controllerClass" => AuthController::class, "methodName" => "loginUser"],
    'logout-user' => ["requestMethod" => "get", "controllerClass" => AuthController::class, "methodName" => "logoutUser"],
    'admin-page' => ["requestMethod" => "get", "controllerClass" => NewsController::class, "methodName" => "index"],
    'delete-news-item' => ["requestMethod" => "delete", "controllerClass" => NewsController::class, "methodName" => "delete"],
    'add-news-item' => ["requestMethod" => "post", "controllerClass" => NewsController::class, "methodName" => "add"],
    'edit-news' => ["requestMethod" => "get", "controllerClass" => NewsController::class, "methodName" => "edit"],
    'update-news-item' => ["requestMethod" => "post", "controllerClass" => NewsController::class, "methodName" => "update"],
    '404' => ["requestMethod" => "get", "controllerClass" => PageNotFoundController::class, "methodName" => "index"]
];
