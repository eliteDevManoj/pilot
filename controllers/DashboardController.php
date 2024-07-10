<?php

class DashboardController {
    
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function index(){

        if(!isset($_SESSION['auth']['id'])){

            header('Location: /login');
            exit;
        }
        
        require 'templates/dashboard.php';
        exit;
    }

    public function homePage(){

        if(isset($_SESSION['auth']['id'])){

            header('Location: /dashboard');
            exit;
        }

        header('Location: /login');
        exit;
    }
}