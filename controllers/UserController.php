<?php

require 'models/User.php';

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
                header('Location: ../../../register.php');
                exit;
            }
        }

        $user = new User($this->db);
        $addUser = $user->create();

        $this->db->close();
        if(isset($addUser['is_error'])){
            
            if($addUser['is_error']){

                $_SESSION['error_msg'] = $addUser['error_msg'];
                header('Location: ../../../register.php');
                exit;
            }
            else{

                $_SESSION['success_msg'] = $addUser['success_msg'];
                header('Location: ../../../index.php');
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

    public function create(){

        $validationUser = $this->validateUserRegister();

        if(isset($validationUser['is_error'])){

            if($validationUser['is_error']){
                
                $this->db->close();
                $_SESSION['error_msg'] = $validationUser['error_msg'];
                header('Location: ../templates/admin/users/add.php');
                exit;
            }
            else{

                $user = new User($this->db);
                $addUser = $user->create();
        
                $this->db->close();
                if(isset($addUser['is_error'])){
                    
                    if($addUser['is_error']){
        
                        $_SESSION['error_msg'] = $addUser['error_msg'];
                        header('Location: ../templates/admin/users/add.php');
                        exit;
                    }
                    else{
        
                        $_SESSION['success_msg'] = $addUser['success_msg'];
                        header('Location: ../templates/admin/users/add.php');
                        exit;
                    }
                }
            }
        }
    }

    public function edit($userId){

        $user = new User($this->db);

        $getUser = $user->getById($userId);

        include 'templates/admin/users/edit.php';
        die;
    }

    public function update($userId){

        $user = new User($this->db);

        $updateUser = $user->update($userId);

        $this->db->close();
        if(isset($updateUser['is_error'])){
            
            if($updateUser['is_error']){

                $_SESSION['error_msg'] = $updateUser['error_msg'];
                header("Location: ../../../routes.php?model=user&action=edit&id=".$userId."");
                exit;
            }
            else{

                $_SESSION['success_msg'] = $updateUser['success_msg'];
                header("Location: ../../../routes.php?model=user&action=edit&id=".$userId."");
                exit;
            }
        }
    }
}