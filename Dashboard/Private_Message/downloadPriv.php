<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "solid";

$connection_string = mysqli_connect($host,$user,$password,$database)or die(mysqli_error());

$my_file_path = $_GET["my_file_path"];

$selected_user_uploads_table = $_COOKIE["correct_Uploads_Table"];

$get_files = "SELECT * FROM $selected_user_uploads_table WHERE file_path='$my_file_path' LIMIT 1";
$execute_get_files = mysqli_query($connection_string,$get_files);

header("Content-Type:application/octet-stream");
header("Content-Disposition:application;filename=".basename($my_file_path));
header("Content-Length:".filesize($my_file_path));
readfile($my_file_path);

?>