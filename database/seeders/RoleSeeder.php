<?php

class RoleSeeder {

    public $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function seed(){
        
        $checkSuperAdminRole = "SELECT * FROM roles WHERE role_name = 'super admin'";

        if($this->db->query($checkSuperAdminRole)->num_rows == 0){

            $superAdminRole = "INSERT INTO roles(role_name) VALUES('super admin')";
            $this->db->query($superAdminRole);
        }

        $checkAdminRole = "SELECT * FROM roles WHERE role_name = 'admin'";

        if($this->db->query($checkAdminRole)->num_rows == 0){

            $adminRole = "INSERT INTO roles(role_name) VALUES('admin')";
            $this->db->query($adminRole);
        }

        $checkStandardRole = "SELECT * FROM roles WHERE role_name = 'standard'";

        if($this->db->query($checkStandardRole)->num_rows == 0){

            $standardRole = "INSERT INTO roles(role_name) VALUES('standard')";
            $this->db->query($standardRole);
        }
    }
}

