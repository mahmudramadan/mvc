<?php

require __DIR__ . '/vendor/autoload.php';
const BASE_URL = "http://localhost/mvc/";
error_reporting(E_ALL);
session_start();
require __DIR__ . "/src/config/database.php";
require __DIR__ . '/src/Bootstrap.php';
