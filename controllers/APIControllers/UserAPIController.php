<?php

require 'models/User.php';

class UserAPIController {

    private $db;

    public function __construct($conn)
    {
        
        $this->db = $conn;
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
        
        $response = [
            'error' => true,
            'error_msg' => 'something went wrong.'
        ];

        $validationUser = $this->validateUserRegister();

        if(isset($validationUser['is_error'])){

            if($validationUser['is_error']){

                $this->db->close();

                $response = [
                    'error' => true,
                    'error_msg' => $validationUser['error_msg']
                ];

                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['data' => $response]);
            }
            else{

                $user = new User($this->db);
                $addUser = $user->create();
        
                $this->db->close();
                if(isset($addUser['is_error'])){
                    
                    if($addUser['is_error']){
        
                        $response = [
                            'error' => true,
                            'error_msg' => $addUser['error_msg']
                        ];

                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['data' => $response]);
                    }
                    else{
        
                        $response = [
                            'success' => true,
                            'success_msg' => $addUser['success_msg']
                        ];

                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['data' => $response]);
                    }
                }
            }
        }
    }

    public function update(){

        $userId = $_POST['id'];

        $user = new User($this->db);

        $updateUser = $user->update($userId);

        $this->db->close();
        if(isset($updateUser['is_error'])){
            
            if($updateUser['is_error']){

                $response = [
                    'error' => true,
                    'error_msg' => $updateUser['error_msg']
                ];

                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['data' => $response]);
            }
            else{

                $response = [
                    'success' => true,
                    'success_msg' => $updateUser['success_msg']
                ];

                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['data' => $response]);
            }
        }
    }

    public function delete(){

        $input_data = json_decode(file_get_contents('php://input'), true);

        if (isset($input_data['userId'])) {

            $userId = $input_data['userId'];

            $user = new User($this->db);
            $userDelete = $user->delete($userId);

            if(isset($userDelete['is_error'])){
            
                if($userDelete['is_error']){
    
                    $response = [
                        'error' => true,
                        'error_msg' => $userDelete['error_msg']
                    ];
    
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['data' => $response]);
                }
                else{
    
                    $response = [
                        'success' => true,
                        'success_msg' => $userDelete['success_msg']
                    ];
    
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['data' => $response]);
                }
            }
        }
    }
}