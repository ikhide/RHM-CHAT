<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "solid";



$connection_string = mysqli_connect($host,$user,$password,$database)or die(mysqli_error());

$selected_user_uploads_table = $_COOKIE["correct_Uploads_Table"];

$get_files = "SELECT * FROM $selected_user_uploads_table";
$execute_get_files = mysqli_query($connection_string,$get_files);

while($get_file_list = mysqli_fetch_array($execute_get_files)){

	$file_name = $get_file_list["File"];
	$file_path = "uploads/".$file_name;
	$file_id = $get_file_list["ID"];
	$font = "<span class='fa fa-trash'></span>";

	echo "<div class='div_style'>";

	echo "<span style='float:left;color:#45a2ff'>".$file_name."</span><br><br>";

	echo "<form action='deletePriv.php' method='post' style='float:right; margin-left:6px;'>
			<button type='submit' class='btn btn-danger btn-sm'>
				<span class='fa fa-trash'></span>
			</button>
			<input name='my_file' id='my_file type='text' value='$file_name' hidden/></span>
		  </form>";
	echo "<a href='downloadPriv.php?my_file_path=$file_path'>
			<img src='../img/download.png' width='30px' height='30px' style='float:right;margin-top:-5px;'>
			</a><br>";

	echo "</div>";
}
?>


<html>

<head>

</head>

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

<body>



</body>


</html>