<?php 
    session_start();

    if(isset($_SESSION['username'])){

        unset($_SESSION['name']);
        unset($_SESSION['user_id']);
        session_destroy();

    }

    session_abort();

    header("location: index.php");
?>