<?php
require 'Router.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];
$params = $_SERVER['QUERY_STRING'];

$router = new Router($conn);

$router->get('/', 'DashboardController', 'homePage');

$router->get('/dashboard', 'DashboardController', 'index');

$router->get('/register', 'AuthController', 'registerForm');

$router->post('/register', 'UserController', 'register');

$router->get('/login', 'AuthController', 'loginForm');

$router->post('/login', 'AuthController', 'authenticate');

$router->get('/logout', 'AuthController', 'logout');


$router->get('/admin/users/listing', 'UserController', 'index');

$router->get('/admin/users/add', 'UserController', 'add');

$router->post('/admin/users/add', 'UserController', 'create');

$router->get('/admin/users/edit', 'UserController', 'show');

$router->post('/admin/users/update', 'UserController', 'update');

$router->route($uri, $method, $params);