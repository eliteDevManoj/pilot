<?php

require '../../db_connect.php';

session_start();

if(!isset($_POST['user_email'])){

    $_SESSION['error_msg'] = 'email is a required field';

    header('Location: ../../register.php');
    exit;
}

if(!isset($_POST['user_password'])){

    $_SESSION['error_msg'] = 'password is a required field';

    header('Location: ../../register.php');
    exit;
}


$usersCheckEmailQuery = "SELECT email FROM users WHERE email='".$_POST['user_email']."'";

$usersEmailExists = $conn->query($usersCheckEmailQuery);
if($usersEmailExists->num_rows > 0){

    $_SESSION['error_msg'] = 'user already exist with the provided email';   
    
    header('Location: ../../register.php');
    exit; 
}

$usersAddQuery = "INSERT INTO users (email, password) VALUES ('".$_POST['user_email']."', '".$_POST['user_password']."')";

$usersAdd = $conn->query($usersAddQuery);
if(!$usersAdd){

    $_SESSION['error_msg'] = 'User registration failed!';
}

$_SESSION['success_msg'] = 'User registered successfully!';
$conn->close();

header('Location: ../../login.php');
exit;
