<?php

use Core\Router;
use Core\Session;
use Core\ValidationException;

session_start();
const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
    //Core\Database
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    require BASE_PATH("{$class}.php");
});

require BASE_PATH("bootstrap.php");

$router = new Router();

$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try{
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}

Session::unflash();