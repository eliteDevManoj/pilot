<?php
require 'models/Role.php';

require 'models/UserHasRole.php';

class User {

    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function create(){

        $response = [];

        $email = $_POST['user_email'];
        $password = $_POST['user_password'];
        $name = isset($_POST['user_name']) ? $_POST['user_name'] : NULL;
        $phone = isset($_POST['user_phone']) ? $_POST['user_phone'] : NULL;
      
        $usersCheckEmailQuery = "SELECT email FROM users WHERE email='". $email."'";

        $usersEmailExists = $this->db->query($usersCheckEmailQuery);
        if($usersEmailExists->num_rows > 0){

            $response = [
                'error_msg' => 'user already exist with the provided email',
                'is_error' => true
            ];

            return $response;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $usersAddQuery = "INSERT INTO users (email, password, name, phone) 
                            VALUES ('".$email."', '".$passwordHash."', '".$name."', '".$phone."')
                          ";

        $usersAdd = $this->db->query($usersAddQuery);
        if(!$usersAdd){

            $response = [
                'error_msg' => 'User registration failed!',
                'is_error' => true
            ];

            return $response;
        }

        $userQuery = "SELECT * FROM users WHERE email='".$email."'";

        $fetchUserQuery = $this->db->query($userQuery);
        while($user = $fetchUserQuery->fetch_assoc()){
            
            $userData = [];
            $userData['user_id'] = $user['id'];
            $userData['address'] = isset($_POST['user_address']) ? $_POST['user_address'] : NULL;
            $userData['country'] = isset($_POST['user_country']) ? $_POST['user_country'] : NULL;
            $userData['state'] = isset($_POST['user_state']) ? $_POST['user_state'] : NULL;
            $userData['city'] = isset($_POST['user_city']) ? $_POST['user_city'] : NULL;
            $userData['postal_code'] = isset($_POST['user_postal_code']) ? $_POST['user_postal_code'] : NULL;
            
            $is_profile_public = isset($_POST['is_profile_public']) ? $_POST['is_profile_public'] : 1;

            $is_public = 'ACTIVE';
    
            if($is_profile_public == 0){
    
                $is_public = 'INACTIVE';
            }
    
            $userData['is_public'] = $is_public;
           
            $userData['file'] = isset( $_FILES["file"]) ?  $_FILES["file"] : NULL;

            $this->updateProfile($user['id'], $userData);

            $roles = new Role($this->db);

            $standardRole = $roles->roleByName('standard');

            if(isset($standardRole[0]['role_name']) && isset($user['id'])){

                $this->assignRole($user['id'], $standardRole[0]['id']);
            }
        }

        $response = [
            'success_msg' => 'User registered successfully!',
            'is_error' => false
        ];
        
        return $response;
    }

    public function updateProfile($userId, $userData){

        $response = [];

        $userSearchQuery = "SELECT * FROM user_profile WHERE user_id = '".$userId."'";
        $userSearchQueryResult = $this->db->query($userSearchQuery);

        if($userSearchQueryResult->num_rows == 0){

            $addUserProfileQuery = "INSERT INTO user_profile(user_id, address, country, state, city, postal_code, is_public) 
                                    VALUES(
                                        '".$userData['user_id']."', 
                                        '".$userData['address']."', 
                                        '".$userData['country']."', 
                                        '".$userData['state']."',
                                        '".$userData['city']."', 
                                        '".$userData['postal_code']."',
                                        '".$userData['is_public']."'
                                    )";

            $this->db->query($addUserProfileQuery);
        }else{

            $updateUserProfileQuery = "UPDATE user_profile SET
                                            address = '".$userData['address']."', 
                                            country = '".$userData['country']."',
                                            state = '".$userData['state']."', 
                                            city = '".$userData['city']."',
                                            postal_code = '".$userData['postal_code']."', 
                                            is_public = '".$userData['is_public']."'
                                            WHERE user_id = '".$userId."'
                                        ";

            $this->db->query($updateUserProfileQuery);
        }
       
        $userProfileQuery = "SELECT * FROM user_profile WHERE id = '".$userId."'";
        $userProfileQueryResult = $this->db->query($userProfileQuery);
        
        $userProfileRow = $userProfileQueryResult->fetch_assoc();
        $userOldProfilePhoto = isset($userProfileRow['photo']) ? $userProfileRow['photo'] : NULL;
       
        if(empty($userData['old_profile_pic']) && isset($userOldProfilePhoto)){

            if(file_exists($userOldProfilePhoto)){
               
                unlink($userOldProfilePhoto);
            }

            $userOldProfilePhoto = NULL;
        }
        
        /** upload new profile if exists */
        $userProfilePhoto = NULL;

        $profilePhotoUploadPath = 'uploads/profiles/';
      
        if($userData['file']){

            $fileName = 'img_'.time().'.jpg';

            $uploadedFile = $profilePhotoUploadPath  . basename($fileName);
    
            move_uploaded_file($userData['file']['tmp_name'], $uploadedFile);

            $userProfilePhoto = $profilePhotoUploadPath.$fileName;
        }
        else{

            $userProfilePhoto = isset($userOldProfilePhoto) && !empty($userOldProfilePhoto) && $userOldProfilePhoto != '' ? $userOldProfilePhoto : NULL;
        }
        
        $updateUserProfilePhotoQuery = "UPDATE user_profile SET 
                                        photo = '".$userProfilePhoto."'
                                        WHERE user_id = '".$userId."'
                                    ";

        $this->db->query($updateUserProfilePhotoQuery);

        $response = [
            'success_msg' => 'User profile updated successfully!',
            'is_error' => false
        ];

        return $response;
    }

    public function listing(){

        $response = [];

        $userListingQuery = "SELECT * FROM users WHERE id > 0";

        $queryResult = $this->db->query($userListingQuery);

        while($users = $queryResult->fetch_assoc()){

            $response[] = [
                'id' => $users['id'],
                'name' => $users['name'],
                'email' => $users['email'],
                'phone' => $users['phone'],
                'status' => $users['status'],
                'role' => $this->role($users['id']),
                'profile' => $this->profile($users['id']),
            ];
        }   

        return $response;
    }

    public function role($userId){

        $response = NULL;

        $userListingQuery = "SELECT * FROM user_has_roles WHERE user_id = '".$userId."'";

        $queryResult = $this->db->query($userListingQuery);

        $roleId = NULL;
        while($userRoles = $queryResult->fetch_assoc()){

            $roleId = $userRoles['role_id']; 
        }   

        if($roleId){

            $role = new Role($this->db);
            $roleById = $role->roleById($roleId);

            if(isset($roleById[0]['role_name'])){

                $response = $roleById[0]['role_name'];

                return $response;
            }
        }

        return $response;
    }

    public function assignRole($userId, $roleId){

        if($userId && $roleId){

            $userHasRole = new UserHasRole($this->db);
            $userHasRole->assignRole($userId, $roleId);
        }

        return true;
    }

    public function profile($userId){

        $response = [];

        $userProfileQuery = "SELECT * FROM user_profile WHERE user_id = '".$userId."'";

        $userProfileQueryResult = $this->db->query($userProfileQuery);

        while($row = $userProfileQueryResult->fetch_assoc()){

            $response = $row; 
        }   

        return $response;
    }

    public function activeUsers(){

        $response = [];

        $activeUsersQuery = "SELECT * FROM users WHERE status = 'ACTIVE'";

        $activeUsersResult = $this->db->query($activeUsersQuery);

        while($row = $activeUsersResult->fetch_assoc()){

            $response[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'status' => $row['status'],
                'role' => $this->role($row['id']),
                'profile' => $this->profile($row['id']),
            ];
        }

        return $response;
    }

    public function getById($id){

        $response = [];

        $fetchUserQuery = "SELECT * FROM users WHERE id = '".$id."'";

        $userQueryResult = $this->db->query($fetchUserQuery);

        while($row = $userQueryResult->fetch_assoc()){

            $response = [
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'status' => $row['status'],
                'role' => $this->role($row['id']),
                'profile' => $this->profile($row['id']),
            ];
        }

        return $response;
    }

    public function update($userId){

        $response = [];

        $name = isset($_POST['user_name']) ? $_POST['user_name'] : NULL;
        $phone = isset($_POST['user_phone']) ? $_POST['user_phone'] : NULL;

        $updateUserQUery = "UPDATE users set name='".$name."', phone='".$phone."' WHERE id='".$userId."'" ;

        if(!$this->db->query($updateUserQUery)){

            $response = [
                'error_msg' => 'User updation failed!',
                'is_error' => true
            ];

            return $response;
        }
       
        $is_profile_public = isset($_POST['is_profile_public'][0]) ? $_POST['is_profile_public'][0] : 0;

        $is_public = 'ACTIVE';

        if($is_profile_public == 0){

            $is_public = 'INACTIVE';
        }

        $userData = [
            'address' => isset($_POST['user_address']) ? $_POST['user_address'] : NULL,
            'country' => isset($_POST['user_country']) ? $_POST['user_country'] : NULL,
            'state' => isset($_POST['user_state']) ? $_POST['user_state'] : NULL,
            'city' => isset($_POST['user_city']) ? $_POST['user_city'] : NULL,
            'postal_code' => isset($_POST['user_postal_code']) ? $_POST['user_postal_code'] : NULL,
            'is_public' => $is_public,
            'old_profile_pic' => isset($_POST['old_profile_pic']) ? $_POST['old_profile_pic'] : NULL,
            'file' => isset($_FILES["file"]) ? $_FILES["file"] : NULL
        ];

        $this->updateProfile($userId, $userData);

        $response = [
            'success_msg' => 'User updated successfully!',
            'is_error' => false
        ];

        return $response;
    }

    public function delete($userId){

        $response = [];

        $userExistQuery = "SELECT id FROM users WHERE id = '".$userId."'";
        $userExistQueryResult = $this->db->query($userExistQuery);

        if($userExistQueryResult->num_rows > 0){

            $userDeleteQuery = "DELETE FROM users WHERE id = '".$userId."'";
            $userDeleteQueryResult = $this->db->query($userDeleteQuery);
    
            if($userDeleteQueryResult){
                
                $userProfileExistQuery = "SELECT id FROM user_profile WHERE user_id = '".$userId."'";
                $userProfileExistQueryResult = $this->db->query($userProfileExistQuery);

                if($userProfileExistQueryResult->num_rows > 0){

                    $userProfileRow = $userProfileExistQueryResult->fetch_assoc();

                    if(isset($userProfileRow['photo'])) {

                        if(file_exists(($userProfileRow['photo']))){

                            unlink($userProfileRow['photo']);
                        }
                    }

                    $userProfileQuery = "DELETE FROM user_profile WHERE user_id = '".$userId."'";
                    $this->db->query($userProfileQuery);
                }
                
                $response = [
                    'success_msg' => 'User removed successfully!',
                    'is_error' => false
                ];
                
                return $response;
            }
    
            $response = [
                'error_msg' => 'Removing user operation failed!',
                'is_error' => true
            ];

            return $response;
        }

        $response = [
            'error_msg' => 'User does not exists with the provided Id!',
            'is_error' => true
        ];

        return $response;
    }
}