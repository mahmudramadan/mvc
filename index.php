<?php

use App\Config\Route\Router;
use App\Container;
use App\Kernel;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . "/src/config/database.php";
const BASE_URL = "http://localhost/mvc/";
error_reporting(E_ALL);
session_start();
$kernel = new Kernel(new Router(), new Container());
$kernel->run();
