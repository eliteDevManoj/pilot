<?php

class PermissionSeeder {

    private $db;
    
    public $permissions = [
        'create-user',
        'view-user',
        'edit-user',
        'delete-user'
    ];

    public function __construct($conn)
    {
        
        $this->db = $conn;
    }

    public function seed(){

        foreach($this->permissions as $eachPermission){

            $addPermissionQuery = "INSERT INTO permissions(permission_name) VALUES('".$eachPermission."')";

            $this->db->query($addPermissionQuery);
        }
    }
}
