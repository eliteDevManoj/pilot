<?php

class UserHasRole {

    private $db;

    public function __construct($conn)
    {
        
        $this->db = $conn;
    }

    public function assignRole($userId, $roleId){

        $response = [];

        $assignRoleQuery = "INSERT INTO user_has_roles(user_id, role_id) VALUES('".$userId."', '".$roleId."')";
        
        $assignRoleQueryResult = $this->db->query($assignRoleQuery);

        if(!$assignRoleQueryResult){

            $response = [
                'error_msg' => 'Could not assign role!',
                'is_error' => true,
            ];

            return $response;
        }

        $response = [
            'success_msg' => 'Assigned role successfully!',
            'is_error' => false
        ];

        return $response;
    }
}