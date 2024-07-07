<?php

class Auth {

    private $db;

    public function __construct($conn)
    {

        $this->db = $conn;
    }

    public function authenticate(){

        $response = [];

        $userSearchQuery = "SELECT * FROM users WHERE email = '".$_POST['user_email']."'";

        $userSearchQuery = $this->db->query($userSearchQuery);

        if($userSearchQuery->num_rows == 0){

            $response['error_msg'] = 'user with the provided email does not exist';

            return $response;
        }

        $userId = $email = $passwordHash = null;

        while($authUser = $userSearchQuery->fetch_assoc()){

            $userId = $authUser['id'];
            $email = $authUser['email'];
            $passwordHash = $authUser['password']; 
        }

        if(!password_verify($_POST['user_password'], $passwordHash)){

            $response['error_msg'] = 'password provided does not match.';
            
            return $response;
        }

        $_SESSION['auth'] = ['id' => $userId, 'email' => $email]; 

        $response['success_msg'] = 'Login successfull!';
        
        return $response;
    }
}

