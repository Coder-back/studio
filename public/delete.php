<?php
    require('connection.php');


    if(isset($_POST['delete'])) {
        $id = $_POST['id'];
        $del = "DELETE FROM `$table` WHERE `$id_name` = '$id'";
        $delete_run = mysqli_query($conn,$del);

        if($delete_run){
            header("location:php/destroySession.php");
        }
        else {
        echo mysqli_error($conn);
        }
    }

    function delete($table, $id_name, $user_id) { 
        $del = "DELETE FROM `$table` WHERE `$id_name` = `$user_id`";
        global $conn;
            if(mysqli_query($conn,$del)){
                header("");
            }
            else {
            echo mysqli_error($conn);
            }
        }
?>