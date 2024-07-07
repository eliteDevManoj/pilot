<?php

class CreateRole {

    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function migrate(){

        $dropRolesTableQuery = 'DROP TABLE IF EXISTS roles';

        $this->db->query($dropRolesTableQuery);

        $createRolesTableQuery = "CREATE TABLE roles(
                                    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    role_name VARCHAR(255) NOT NULL,
                                    status ENUM('ACTIVE', 'INACTIVE', 'DELETED') DEFAULT('ACTIVE')
                                )";

        $this->db->query($createRolesTableQuery);
    }
}