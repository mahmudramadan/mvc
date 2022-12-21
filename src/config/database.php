<?php
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB;

$db->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'check24',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$db->setAsGlobal();
// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
//$db->bootEloquent();

