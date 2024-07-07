<?php

class CreateUserHasRole {

    private $db;

    public function __construct($conn)
    {
        
        $this->db = $conn;
    }

    public function migrate(){

        $dropUserHasRolesTableQuery = 'DROP TABLE IF EXISTS user_has_roles';

        $this->db->query($dropUserHasRolesTableQuery);

        $usersHasRolesTableQuery = "CREATE TABLE user_has_roles(
                            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            user_id INT(11) UNSIGNED NOT NULL,
                            role_id INT(11) UNSIGNED NOT NULL
                        )";

        $this->db->query($usersHasRolesTableQuery);
    }
}