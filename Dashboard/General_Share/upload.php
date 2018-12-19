<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "solid";

$connection_string = mysqli_connect($host,$user,$password,$database);

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$file_name = $_FILES["upl"]["name"];
	$tem_name = $_FILES["upl"]["tmp_name"];
	$file_type = $_FILES["upl"]["type"];
	$file_size = $_FILES["upl"]["size"];

	$file_size_kb = ($file_size/1024);
	$file_size_mb =	$file_size_kb/1024;
	if($file_size_mb > 3){
		echo "<script type='text/javascript'>alert('$message');</script>";

	}else{
		$file_name_only = preg_replace("#[^a-z0-9.]#i","",$file_name);
		$date = Date("Ymd_His");
		$file_name = $date."_".$_COOKIE["user_first_name"]."_".$file_name_only;

		$file_path = "uploads/$file_name";

		if(!$tem_name){
			echo '{"status":"error"}';
			die();
		}else{
			move_uploaded_file($tem_name,$file_path);
			$my_insert_query = "INSERT INTO `tbl_general_uploads` (`id`, `file_name`, `file_type`, `file_size`, `file_path`, `date`) VALUES (NULL, '$file_name', '$file_type', '$file_size', '$file_path', CURRENT_TIMESTAMP)";
			$execute_insert_query = mysqli_query($connection_string,$my_insert_query);

			echo '{"status":"success"}';
		}
	}
}

exit;
?>