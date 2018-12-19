<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "solid";

    $connection_string = mysqli_connect($host,$user,$password,$database)or die(mysqli_error());

    $my_file = $_POST["my_file"];

    $get_files = "DELETE FROM tbl_general_uploads WHERE file_name='$my_file' ";
    $execute_get_files = mysqli_query($connection_string,$get_files);

    unlink('uploads/'.$my_file);

    header("Location:General_Share.php");

?>

          