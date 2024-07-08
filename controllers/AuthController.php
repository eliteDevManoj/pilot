<?php
if(!isset($_SESSION)) 
{ 
  session_start(); 
} 

require 'models/Auth.php';

class AuthController {
    
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function loginForm(){

        if(isset($_SESSION['auth']['id'])){

            header('Location: /');
            exit;
        }

        require 'templates/authentication/login.php';
        exit;        
    }

    public function registerForm(){

        if(isset($_SESSION['auth']['id'])){

            header('Location: /');
            exit;
        }
        
        require 'templates/authentication/register.php';
        exit;
    }

    public function authenticate(){

        $LoginValidations = $this->validateLogin();

        if(isset($LoginValidations['isError'])){

            if($LoginValidations['isError']){

                $this->db->close();
                $_SESSION['error_msg'] = $LoginValidations['msg'];
                header('Location: ../../../login.php');
                exit;
            }
        }

        $auth = new Auth($this->db);
        $authResponse = $auth->authenticate();
      
        $this->db->close();
        if(isset($authResponse['error_msg'])){

            $_SESSION['error_msg'] = $authResponse['error_msg'];
            header('Location: ../../../login.php');
            exit;
        }
        else if(isset($authResponse['success_msg'])){

            $_SESSION['success_msg'] = $authResponse['success_msg'];
            header('Location: ../../../index.php');
            exit;
        }
    }

    public function validateLogin(){

        $msg = '';
        $isError = false;

        if(!isset($_POST['user_email'])){

            $msg = 'email is a required field';
            $isError = true;
        }

        if(!isset($_POST['user_password'])){

            $msg = 'password is a required field';
            $isError = true;
        }

        if(empty($_POST['user_email']) || $_POST['user_email'] == ''){
            
            $msg = 'email cannot be empty';
            $isError = true;
        }

        if(empty($_POST['user_password']) || $_POST['user_password'] == ''){

            $msg = 'password cannot be empty';
            $isError = true;
        }

        return [
            'msg' => $msg,
            'isError' => $isError
        ];
    }
}