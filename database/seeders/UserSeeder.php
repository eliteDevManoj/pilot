<?php

require 'models/Role.php';

require 'models/UserHasRole.php';

class UserSeeder {

    private $db;

    public function __construct($conn)
    {
        
        $this->db = $conn;
    }

    public function seed(){

        $superAdminSearchQuery = "SELECT * FROM users WHERE name = 'Super Admin'";

        $superAdminSearchResults = $this->db->query($superAdminSearchQuery);
        if($superAdminSearchResults->num_rows == 0){

            $hashPassword = password_hash('123456', PASSWORD_DEFAULT);
            $userSeedQuery = "INSERT INTO users(email, password, name) VALUES('superadmin@gmail.com', '".$hashPassword."', 'Super Admin')";

            $userSeedResult = $this->db->query($userSeedQuery);
            if($userSeedResult){

                $userId = NULL;
                $userQuery = "SELECT * FROM users WHERE email='superadmin@gmail.com'";

                $fetchUserQuery = $this->db->query($userQuery);
                while($user = $fetchUserQuery->fetch_assoc()){
                    
                    $userId = $user['id'];
                }

                $roles = new Role($this->db);

                $superAdminRole = $roles->roleByName('super admin');

                if(isset($superAdminRole[0]['role_name']) && isset($userId)){

                    $this->assignRole($userId, $superAdminRole[0]['id']);
                }
            }
        }
    }

    public function assignRole($userId, $roleId){

        if($userId && $roleId){

            $userHasRole = new UserHasRole($this->db);
            $userHasRole->assignRole($userId, $roleId);
        }

        return true;
    }
}