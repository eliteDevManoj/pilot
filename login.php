<?php

  require 'db_connect.php';

  session_start();

  if(isset($_SESSION['auth']['id'])){

    header('Location: index.php');
    exit;
  }

  include 'templates/authentication/login.php';
?>

