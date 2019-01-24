<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
<style>
.div_style{
	margin:5px;
	padding:10px;
	background-color:#2E3134;
	border-radius:5px;
}

.div_style:hover{
	background-color: #454748;
}
</style>
</head>
<body>
<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "solid";


$connection_string = mysqli_connect($host,$user,$password,$database)or die(mysqli_error());

$sender = $_COOKIE["user_first_name"];
$receiver = $_COOKIE["default_clicked_on_username"];
$get_files = "SELECT * FROM private_uploads where (sender='$sender' and receiver = '$receiver') or (sender='$receiver' and receiver = '$sender')";
$execute_get_files = mysqli_query($connection_string,$get_files);

while($get_file_list = mysqli_fetch_array($execute_get_files)){

	$file_name = $get_file_list["File"];
	$file_path = "uploads/".$file_name;
	$file_id = $get_file_list["ID"];

	echo "<div class='div_style'>";

		echo "<span style='float:left;color:#45a2ff'>".$file_name."</span><br><br>";

		echo "<div style='float:right; margin-left:6px;'>
				<button onclick="."deleteUpload('$file_name')"." class='btn btn-danger btn-sm'>
					<span class='fa fa-trash'></span>
				</button>
			</div>";
		echo"<a href='downloadPriv.php?my_file_path=$file_path'>
				<img src='../img/download.png' width='30px' height='30px' style='float:right;margin-top:-5px;'>
			</a><br>";
	echo "</div>";
}
?>

</body>
</html>

