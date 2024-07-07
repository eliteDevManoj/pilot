<?php

class CreateRoleHasPermission {

    private $db;

    public function __construct($conn)
    {
        
        $this->db = $conn;
    }

    public function migrate(){

        $dropRoleHasPermissionsTableQuery = 'DROP TABLE IF EXISTS role_has_permissions';

        $this->db->query($dropRoleHasPermissionsTableQuery);

        $roleHasPermissionsTableQuery = "CREATE TABLE role_has_permissions(
                                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                        role_id INT(11) UNSIGNED NOT NULL,
                                        permission_id INT(11) UNSIGNED NOT NULL
                                    )";

        $this->db->query($roleHasPermissionsTableQuery);
    }
}