<?php

require 'db_connect.php';

session_start();

if(!isset($_SESSION['auth']['id'])){

    header('Location: login.php');
    exit;
}

header('Location: templates/dashboard.php');
exit;
?>
