<?php
require 'Router.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];
$params = $_SERVER['QUERY_STRING'];

$router = new Router($conn);

$router->get('/', 'DashboardController', 'homePage');

$router->get('/dashboard', 'DashboardController', 'index');

$router->get('/register', 'AuthController', 'registerForm');

$router->post('/api/register', 'UserAPIController', 'create');

$router->get('/login', 'AuthController', 'loginForm');

$router->post('/login', 'AuthController', 'authenticate');

$router->get('/logout', 'AuthController', 'logout');




$router->get('/admin/users/listing', 'UserController', 'index');

$router->get('/admin/users/add', 'UserController', 'add');

$router->post('/admin/users/add', 'UserController', 'create');

$router->post('/api/admin/users/add', 'UserAPIController', 'create');

$router->get('/admin/users/edit', 'UserController', 'show');

$router->post('/api/admin/users/update', 'UserAPIController', 'update');

$router->delete('/api/admin/users/delete', 'UserAPIController', 'delete');

$router->post('/admin/users/update', 'UserController', 'update');

$router->get('/admin/users/profile', 'UserController', 'profile');

$router->put('/admin/users/profile', 'UserController', 'profileUpdate');

$router->route($uri, $method, $params);