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

$userSearchQuery = "SELECT id FROM users WHERE email = '".$_POST['user_email']."'";

$userSearchQuery = $conn->query($userSearchQuery);

if($userSearchQuery->num_rows == 0){

    $conn->close();
    $_SESSION['error_msg'] = 'Login failed!';
    header('Location: ../../../login.php');
    exit;
}

while($authUser = $userSearchQuery->fetch_assoc()){

    $_SESSION['auth'] = ['id' => $authUser['id'], 'email' => $authUser['email']]; 
}

$conn->close();
$_SESSION['success_msg'] = 'Login successfull!';
header('Location: ../../../index.php');
exit;

