<?php

class CreateUser {
    
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function migrate(){

        $dropUsersTableQuery = 'DROP TABLE IF EXISTS users';

        $this->db->query($dropUsersTableQuery);

        $createUsersTableQuery = "CREATE TABLE users(
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            name VARCHAR(255) NULL,
            phone VARCHAR(255) NULL,
            status ENUM('ACTIVE', 'INACTIVE', 'DELETED') DEFAULT('ACTIVE')
        )";

        $this->db->query($createUsersTableQuery);
    }
}
