<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "solid";

    $connection_string = mysqli_connect($host,$user,$password,$database)or die(mysqli_error());

    $my_file = $_POST["my_file"];

    $selected_user_uploads_table = $_COOKIE["correct_Uploads_Table"];

    $get_files = "DELETE FROM $selected_user_uploads_table WHERE File='$my_file' ";
    $execute_get_files = mysqli_query($connection_string,$get_files);

    unlink('uploads/'.$my_file);

    header("Location:Private_Message.php");

?>

                
             
    