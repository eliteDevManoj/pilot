<?php

$conn = new mysqli('localhost', 'root', '', 'pilot');
if($conn->connect_error){
    
    echo $conn->connect_error;
    die;
}