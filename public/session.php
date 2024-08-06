<?php
//create db connection
session_start();
require('connection.php');

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['username'];
}

/*if(isset($_SESSION['username'])){
    if ($_SESSION['username'] === 'admin'){
        header("location: adminDashboard.php");
      } else {
        header("location: index.php");
      }
}*/
?>