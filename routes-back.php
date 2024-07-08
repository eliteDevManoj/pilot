<?php
 if(!isset($_SESSION)) 
 { 
    session_start(); 
 } 

require 'db_connect.php';

require 'controllers/AuthController.php';

require 'controllers/UserController.php';

if(isset($_POST['login'])){

    $authController = new AuthController($conn);
    return $authController->authenticate();
}

if(isset($_POST['register'])){

    $addUser = new UserController($conn);
    return $addUser->register();
}

if(isset($_POST['create-user'])){

    $createUser = new UserController($conn);
    return $createUser->create();
}

if(isset($_GET['model']) && isset($_GET['action'])){

    if($_GET['model'] == 'user'){

        if($_GET['action'] == 'listing'){

            $createUser = new UserController($conn);
            $createUser->index();
        }

        if($_GET['action'] == 'edit' && isset($_GET['id'])){

            $editUser = new UserController($conn);
            return $editUser->edit($_GET['id']);
        }

        if($_GET['action'] == 'update' && isset($_GET['id'])){

            $updateUser = new UserController($conn);
            $updateUser->update($_GET['id']);
        }
    }
}


