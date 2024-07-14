<?php

class UserController {

    private $db;

    public function __construct($conn)
    {
        
        $this->db = $conn;
    }

    public function index(){
        
        $user = new User($this->db);
        
        $users = $user->listing();

        $activeUsers = $user->activeUsers();

        include 'templates/admin/users/listing.php';
        die;
    }

    public function register(){

        $validationUser = $this->validateUserRegister();

        if(isset($validationUser['is_error'])){

            if($validationUser['is_error']){

                $this->db->close();
                $_SESSION['error_msg'] = $validationUser['error_msg'];
                header('Location: /register');
                exit;
            }
        }

        $user = new User($this->db);
        $addUser = $user->create();

        $this->db->close();
        if(isset($addUser['is_error'])){
            
            if($addUser['is_error']){

                $_SESSION['error_msg'] = $addUser['error_msg'];
                header('Location: /register');
                exit;
            }
            else{

                $_SESSION['success_msg'] = $addUser['success_msg'];
                header('Location: /login');
                exit;
            }
        }
    }

    public function validateUserRegister(){

        $response = [
            'error_msg' => '',
            'is_error' => false
        ];

        if(!isset($_POST['user_email'])){

            $response['error_msg'] = 'email is a required field';

            $response['is_error'] = true;
        }

        if(!isset($_POST['user_password'])){

            $response['error_msg'] = 'password is a required field';

            $response['is_error'] = true;
        }

        if(empty($_POST['user_email']) || $_POST['user_email'] == ''){

            $response['error_msg'] = 'email cannot be empty';

            $response['is_error'] = true;
        }

        if(empty($_POST['user_password']) || $_POST['user_password'] == ''){

            $response['error_msg'] = 'password cannot be empty';

            $response['is_error'] = true;
        }

        return $response;
    }

    public function add(){

        if(!isset($_SESSION['auth']['id'])){

            header('Location: /login');
            exit;
        }

        require 'templates/admin/users/add.php';
        exit;
    }
   
    public function show($params){
    
        $userId = isset($params['id']) ? $params['id'] : NULL;

        if(!isset($userId)){
            
            $_SESSION['error_msg'] = 'Cannot find the user with given Id';
            header('Location: /admin/users/listing');
            exit;
        }

        $user = new User($this->db);

        $getUser = $user->getById($userId);

        include 'templates/admin/users/edit.php';
        die;
    }

    public function profile(){

        $userId = isset($_SESSION['auth']['id']) ? $_SESSION['auth']['id'] : NULL;

        if(!isset($userId)){
            
            $_SESSION['error_msg'] = 'Cannot find the user with given Id';
            header('Location: /login');
            exit;
        }

        $user = new User($this->db);

        $getUser = $user->getById($userId);

        include 'templates/admin/users/profile.php';
        die;
    }

    public function profileUpdate(){

        $userId = $_POST['id'];

        $user = new User($this->db);

        $updateUser = $user->update($userId);

        $this->db->close();
        if(isset($updateUser['is_error'])){
            
            if($updateUser['is_error']){

                $_SESSION['error_msg'] = $updateUser['error_msg'];
                header("Location: /admin/users/profile");
                exit;
            }
            else{

                $_SESSION['success_msg'] = $updateUser['success_msg'];
                header("Location: /admin/users/profile");
                exit;
            }
        }
    }
}