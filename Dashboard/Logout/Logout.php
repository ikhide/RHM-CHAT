<?php

$host = "localhost";
$user = "root";
$pass = "";
$database = "solid";

$users_first_name = $_COOKIE["user_first_name"];
$users_last_name = $_COOKIE["users_last_name"];

$connection_String = mysqli_connect($host,$user,$pass,$database);

$command_query = "UPDATE `users_online` SET status = 'offline' WHERE first_name = '$users_first_name' AND last_name = '$users_last_name'";

$execute_command_query = mysqli_query($connection_String,$command_query);

setcookie("user_first_name", " ");
setcookie("users_last_name"," ");
setcookie("user_department"," ");
setcookie("user_position", " ");

setcookie("default_clicked_on_username", " ");

setcookie("clicked_on_user_last_name"," ");

setcookie("Selected_Username_Table", "dummy_text"," ");
setcookie("Reversed_selected_Username_Table", " ");

setcookie("selected_Username_Table_uploads", " ");
setcookie("reversed_selected_Username_Table_uploads", " ");


 ?>
