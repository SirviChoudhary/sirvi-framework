<?php 
require_once __DIR__.'/../vendor/autoload.php';


use App\Core\Router;
use App\Core\Env;

Env::load(__DIR__.'/../.env');

$router = new Router();

require_once __DIR__.'/../routes/api.php';

// use App\Core\Env;
// use App\Core\Database;

// Env::load(__DIR__.'/../.env');

// $conn = Database::connect();


$router->dispatch();

?>