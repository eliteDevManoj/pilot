<?php

class CreatePermission {

    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function migrate(){

        $dropPermissionsTableQuery = 'DROP TABLE IF EXISTS permissions';

        $this->db->query($dropPermissionsTableQuery);

        $permissionsTableQuery = "CREATE TABLE permissions(
                                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                permission_name VARCHAR(255) NOT NULL,
                                status ENUM('ACTIVE', 'INACTIVE', 'DELETED') DEFAULT('ACTIVE')
                            )";

        $this->db->query($permissionsTableQuery);
    }
}