<?php
require 'Router.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router($conn);

$router->get('/', 'DashboardController', 'index');

$router->get('/login', 'AuthController', 'loginForm');

$router->get('/register', 'AuthController', 'registerForm');

$router->route($uri, $method);