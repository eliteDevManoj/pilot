<?php

require '../../db_connect.php';

session_start();

$msg = '';
$isError = false;

if(!isset($_POST['user_email'])){

    $msg = 'email is a required field';
    $isError = true;
}

if(!isset($_POST['user_password'])){

    $msg = 'password is a required field';
    $isError = true;
}

if(empty($_POST['user_email']) || $_POST['user_email'] == ''){
    
    $msg = 'email cannot be empty';
    $isError = true;
}

if(empty($_POST['user_password']) || $_POST['user_password'] == ''){

    $msg = 'password cannot be empty';
    $isError = true;
}

if($isError){

    $conn->close();
    $_SESSION['error_msg'] = $msg;
    header('Location: ../../../login.php');
    exit;
}

$userSearchQuery = "SELECT * FROM users WHERE email = '".$_POST['user_email']."'";

$userSearchQuery = $conn->query($userSearchQuery);

if($userSearchQuery->num_rows == 0){

    $conn->close();
    $_SESSION['error_msg'] = 'user with the provided email does not exist';
    header('Location: ../../../login.php');
    exit;
}

$userId = $email = $passwordHash = null;

while($authUser = $userSearchQuery->fetch_assoc()){

    $userId = $authUser['id'];
    $email = $authUser['email'];
    $passwordHash = $authUser['password']; 
}

if(!password_verify($_POST['user_password'], $passwordHash)){

    $_SESSION['error_msg'] = 'password provided does not match.';
    header('Location: ../../../login.php');
    exit;
}

$_SESSION['auth'] = ['id' => $userId, 'email' => $email]; 

$conn->close();
$_SESSION['success_msg'] = 'Login successfull!';
header('Location: ../../../index.php');
exit;

