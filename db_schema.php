<?php

require 'db_connect.php';
    
$createUsersTable = 'CREATE TABLE users(id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                    email VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL)';

$conn->query($createUsersTable);


