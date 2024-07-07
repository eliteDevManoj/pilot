<?php

class CreateUserProfile {

    private $db;

    public function __construct($conn)
    {
        
        $this->db = $conn;
    }

    public function migrate(){

        $dropUserProfileQuery = "DROP TABLE IF EXISTS user_profile";
        $this->db->query($dropUserProfileQuery);

        $createUserProfileQuery = "CREATE TABLE user_profile(
                                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                        user_id INT(11) UNSIGNED NOT NULL,
                                        photo VARCHAR(500) NULL,
                                        address VARCHAR(500) NULL,
                                        country VARCHAR(100) NULL,
                                        state VARCHAR(100) NULL,
                                        city VARCHAR(100) NULL,
                                        postal_code VARCHAR (50) NULL,
                                        is_public ENUM('ACTIVE', 'INACTIVE') DEFAULT('ACTIVE')            
                                    )";

        $this->db->query($createUserProfileQuery);
    }
}