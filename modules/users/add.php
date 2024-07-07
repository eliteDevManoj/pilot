<?php

require '../../db_connect.php';

session_start();

$isError = false;

if(!isset($_POST['user_email'])){

    $_SESSION['error_msg'] = 'email is a required field';

    $isError = true;
}

if(!isset($_POST['user_password'])){

    $_SESSION['error_msg'] = 'password is a required field';

    $isError = true;
}

if(empty($_POST['user_email']) || $_POST['user_email'] == ''){

    $_SESSION['error_msg'] = 'email cannot be empty';

    $isError = true;
}

if(empty($_POST['user_password']) || $_POST['user_password'] == ''){

    $_SESSION['error_msg'] = 'password cannot be empty';

    $isError = true;
}

$usersCheckEmailQuery = "SELECT email FROM users WHERE email='".$_POST['user_email']."'";

$usersEmailExists = $conn->query($usersCheckEmailQuery);
if($usersEmailExists->num_rows > 0){

    $_SESSION['error_msg'] = 'user already exist with the provided email';   

    $isError = true;
}

if($isError){

    header('Location: ../../register.php');
    exit;
}

$passwordHash = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

$usersAddQuery = "INSERT INTO users (email, password) VALUES ('".$_POST['user_email']."', '".$passwordHash."')";

$usersAdd = $conn->query($usersAddQuery);
if(!$usersAdd){

    $_SESSION['error_msg'] = 'User registration failed!';

    $isError = true;
}

if($isError){

    header('Location: ../../register.php');
    exit;
}

$_SESSION['success_msg'] = 'User registered successfully!';
$conn->close();

header('Location: ../../login.php');
exit;
