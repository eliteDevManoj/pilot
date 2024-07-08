<?php
require 'controllers/AuthController.php';

require 'controllers/DashboardController.php';

require 'controllers/UserController.php';

class Router {

    private $db;

    protected $routes = [];

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function add($method, $uri, $controller, $action){

        $this->routes[] = compact('method', 'uri', 'controller', 'action');
    }

    public function get($uri, $controller, $action){

        $this->add('GET', $uri, $controller, $action);
    }

    public function post($uri, $controller, $action){

        $this->add('POST', $uri, $controller, $action);
    }

    public function route($uri, $method){

        foreach($this->routes as $route){
            if($route['uri'] === $uri && $route['method'] === strtoupper($method)){

                $optController = $route['controller'];
                $optAction = $route['action'];
                
                $controller = new $optController($this->db);
                $controller->$optAction();
                exit;
            }
        }

        http_response_code(404);
        die;
    }
}