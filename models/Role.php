<?php

class Role {

    private $db;

    public function __construct($conn)
    {
    
        $this->db = $conn;
    }

    public function listing(){

        $response = [];

        $rolesFetchQuery = "SELECT * FROM roles WHERE id > 0";

        $results = $this->db->query($rolesFetchQuery);

        while($roles = $results->fetch_assoc()){

            $response[] = $roles;
        }

        return $response;
    }

    public function roleByName($roleName){

        $response = [];

        $roleSearchByNameQuery = "SELECT * FROM roles WHERE role_name = '".strtolower($roleName)."'";

        $results = $this->db->query($roleSearchByNameQuery);

        while($role = $results->fetch_assoc()){

            $response[] = $role;
        }

        return $response;
    }

    public function roleById($roleId){

        $response = [];

        $roleSearchByNameQuery = "SELECT * FROM roles WHERE id = '".strtolower($roleId)."'";

        $results = $this->db->query($roleSearchByNameQuery);

        while($role = $results->fetch_assoc()){

            $response[] = $role;
        }

        return $response;
    }
}